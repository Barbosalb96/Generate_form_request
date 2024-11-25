<?php

namespace barbosalb96\Blade;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateBladeRequestCommand extends Command
{
    protected $signature = 'make:form-from-request {request} type {type}';
    protected $description = 'Gera um formulário Blade com base no Request fornecido, com as validações necessárias';

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
            $required = in_array('required', explode('|', $validationRules)) ? 'required' : '';

            if (str_contains($validationRules, 'string')) {
                $fieldType = 'text';
            } elseif (str_contains($validationRules, 'integer')) {
                $fieldType = 'number';
            } elseif (str_contains($validationRules, 'boolean')) {
                $fieldType = 'checkbox';
            } elseif (str_contains($validationRules, 'date')) {
                $fieldType = 'date';
            } elseif (str_contains($validationRules, 'email')) {
                $fieldType = 'email';
            }

            $formFields[] = [
                'name' => $field,
                'label' => $fieldLabel,
                'type' => $fieldType,
                'required' => $required,
            ];
        }

        if ($type == 'tailwind') {
            $bladeContent = view('form_template_tailwind', compact('formFields'));
        } else {
            $bladeContent = view('form_template_bootstrap', compact('formFields'));
        }


        $formPath = resource_path("views/{$requestName}.blade.php");

        if (File::exists($formPath)) {
            $this->info("O formulário Blade já existe: {$formPath}");
            return;
        }

        File::put($formPath, $bladeContent);

        $this->info("Formulário gerado com sucesso: {$formPath}");
    }
}