<?php

namespace barbosalb96\Blade;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateBladeRequestCommand extends Command
{
    protected $signature = 'make:form-from-request {request} {type}';
    protected $description = 'Gera um formulário Blade com base no Request fornecido, com as validações necessárias.';

    public function handle()
    {
        $requestName = $this->argument('request');
        $type = $this->argument('type');
        $requestClass = "App\\Http\\Requests\\$requestName";

        if (!class_exists($requestClass)) {
            $this->error("O Request {$requestName} não foi encontrado.");
            return;
        }

        $request = new $requestClass();
        $rules = $request->rules();
        $formFields = [];

        foreach ($rules as $field => $validationRules) {
            $fieldLabel = ucfirst(str_replace('_', ' ', $field));
            $fieldType = 'text';

            if (is_array($validationRules)) {
                $validationRules = implode('|', $validationRules);
            }

            $required = in_array('required', explode('|', $validationRules)) ? 'required' : '';

            if (str_contains($validationRules, 'string')) {
                $fieldType = 'text';
            } elseif (str_contains($validationRules, 'integer')) {
                $fieldType = 'number';
            } elseif (str_contains($validationRules, 'boolean')) {
                $fieldType = 'checkbox';
            } elseif (str_contains($validationRules, '|in:')) {
                $fieldType = 'select';
            } elseif (str_contains($validationRules, 'date')) {
                $fieldType = 'date';
            } elseif (str_contains($validationRules, 'email')) {
                $fieldType = 'email';
            } else {
                $fieldType = 'password';
            }

            if (str_contains($validationRules, '|in:')) {
                $ruleParts = explode('|in:', $validationRules);
                $optionsString = isset($ruleParts[1]) ? explode('|', $ruleParts[1])[0] : '';
                $options = explode(',', $optionsString);

                $formFields[] = [
                    'name' => $field,
                    'label' => $fieldLabel,
                    'type' => $fieldType,
                    'required' => $required,
                    'options' => $options,
                ];
            } else {
                $formFields[] = [
                    'name' => $field,
                    'label' => $fieldLabel,
                    'type' => $fieldType,
                    'required' => $required,
                ];
            }
        }

        // Determine the Blade template based on the type
        $bladeTemplate = $type === 'tailwind' ? 'form_template_tailwind' : 'form_template_bootstrap';

        if (!view()->exists($bladeTemplate)) {
            $this->error("O template Blade {$bladeTemplate} não foi encontrado.");
            return;
        }

        $bladeContent = view($bladeTemplate, compact('formFields'))->render();
        $formPath = resource_path("views/{$requestName}.blade.php");

        if (File::exists($formPath)) {
            $this->info("O formulário Blade já existe: {$formPath}");
            return;
        }

        File::put($formPath, $bladeContent);
        $this->info("Formulário gerado com sucesso: {$formPath}");
    }
}
