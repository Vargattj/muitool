<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Tool;
use App\Models\ToolTranslation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Text Tools category
        $category = Category::create([
            'slug' => 'text-tools',
            'icon' => 'text-icon.svg',
            'order' => 1,
        ]);

        // Create category translations
        CategoryTranslation::create([
            'category_id' => $category->id,
            'locale' => 'en',
            'name' => 'Text Tools',
            'description' => 'Tools for text manipulation, formatting, and conversion',
        ]);

        CategoryTranslation::create([
            'category_id' => $category->id,
            'locale' => 'pt_BR',
            'name' => 'Ferramentas de Texto',
            'description' => 'Ferramentas para manipulação, formatação e conversão de texto',
        ]);

        CategoryTranslation::create([
            'category_id' => $category->id,
            'locale' => 'es',
            'name' => 'Herramientas de Texto',
            'description' => 'Herramientas para manipulación, formateo y conversión de texto',
        ]);

        // Create JSON Formatter tool
        $tool = Tool::create([
            'category_id' => $category->id,
            'slug' => 'json-formatter',
            'icon' => 'json-icon.svg',
            'view_component' => 'json-formatter',
            'is_active' => true,
            'meta_data' => [
                'version' => '1.0',
                'features' => ['format', 'validate', 'minify'],
            ],
        ]);

        // Create tool translations - English
        ToolTranslation::create([
            'tool_id' => $tool->id,
            'locale' => 'en',
            'name' => 'JSON Formatter',
            'short_description' => 'Format, validate, and beautify JSON data online',
            'description' => 'Our JSON Formatter is a powerful online tool that helps you format, validate, and beautify JSON data. Perfect for developers who need to quickly format JSON responses, validate JSON syntax, or make JSON more readable. The tool supports syntax highlighting, error detection, and one-click formatting.',
            'meta_title' => 'JSON Formatter - Format and Validate JSON Online | MuiTool',
            'meta_description' => 'Free online JSON formatter and validator. Format, beautify, and validate JSON data instantly. Perfect for developers and API testing.',
            'faq' => [
                [
                    'question' => 'What is JSON?',
                    'answer' => 'JSON (JavaScript Object Notation) is a lightweight data-interchange format that is easy for humans to read and write and easy for machines to parse and generate.',
                ],
                [
                    'question' => 'How do I use the JSON Formatter?',
                    'answer' => 'Simply paste your JSON data into the input field and click the "Format" button. The tool will automatically format and validate your JSON.',
                ],
                [
                    'question' => 'Is my data secure?',
                    'answer' => 'Yes! All formatting is done client-side in your browser. Your data never leaves your computer.',
                ],
            ],
            'use_cases' => [
                [
                    'title' => 'API Response Formatting',
                    'description' => 'Format API responses to make them more readable during development and debugging.',
                ],
                [
                    'title' => 'Configuration Files',
                    'description' => 'Validate and format JSON configuration files for applications.',
                ],
                [
                    'title' => 'Data Validation',
                    'description' => 'Quickly validate JSON syntax before using it in your applications.',
                ],
                [
                    'title' => 'Learning and Education',
                    'description' => 'Great for students learning about JSON structure and syntax.',
                ],
            ],
        ]);

        // Create tool translations - Portuguese (Brazil)
        ToolTranslation::create([
            'tool_id' => $tool->id,
            'locale' => 'pt_BR',
            'name' => 'Formatador JSON',
            'short_description' => 'Formate, valide e embeleze dados JSON online',
            'description' => 'Nosso Formatador JSON é uma ferramenta online poderosa que ajuda você a formatar, validar e embelezar dados JSON. Perfeito para desenvolvedores que precisam formatar rapidamente respostas JSON, validar sintaxe JSON ou tornar o JSON mais legível. A ferramenta suporta destaque de sintaxe, detecção de erros e formatação com um clique.',
            'meta_title' => 'Formatador JSON - Formate e Valide JSON Online | MuiTool',
            'meta_description' => 'Formatador e validador JSON online gratuito. Formate, embeleze e valide dados JSON instantaneamente. Perfeito para desenvolvedores e testes de API.',
            'faq' => [
                [
                    'question' => 'O que é JSON?',
                    'answer' => 'JSON (JavaScript Object Notation) é um formato leve de intercâmbio de dados que é fácil para humanos lerem e escreverem e fácil para máquinas analisarem e gerarem.',
                ],
                [
                    'question' => 'Como uso o Formatador JSON?',
                    'answer' => 'Simplesmente cole seus dados JSON no campo de entrada e clique no botão "Formatar". A ferramenta formatará e validará automaticamente seu JSON.',
                ],
                [
                    'question' => 'Meus dados estão seguros?',
                    'answer' => 'Sim! Toda a formatação é feita no lado do cliente em seu navegador. Seus dados nunca saem do seu computador.',
                ],
            ],
            'use_cases' => [
                [
                    'title' => 'Formatação de Respostas de API',
                    'description' => 'Formate respostas de API para torná-las mais legíveis durante o desenvolvimento e depuração.',
                ],
                [
                    'title' => 'Arquivos de Configuração',
                    'description' => 'Valide e formate arquivos de configuração JSON para aplicações.',
                ],
                [
                    'title' => 'Validação de Dados',
                    'description' => 'Valide rapidamente a sintaxe JSON antes de usá-la em suas aplicações.',
                ],
                [
                    'title' => 'Aprendizado e Educação',
                    'description' => 'Ótimo para estudantes aprendendo sobre estrutura e sintaxe JSON.',
                ],
            ],
        ]);

        // Create tool translations - Spanish
        ToolTranslation::create([
            'tool_id' => $tool->id,
            'locale' => 'es',
            'name' => 'Formateador JSON',
            'short_description' => 'Formatee, valide y embellezca datos JSON en línea',
            'description' => 'Nuestro Formateador JSON es una poderosa herramienta en línea que le ayuda a formatear, validar y embellecer datos JSON. Perfecto para desarrolladores que necesitan formatear rápidamente respuestas JSON, validar sintaxis JSON o hacer que JSON sea más legible. La herramienta admite resaltado de sintaxis, detección de errores y formateo con un clic.',
            'meta_title' => 'Formateador JSON - Formatee y Valide JSON en Línea | MuiTool',
            'meta_description' => 'Formateador y validador JSON en línea gratuito. Formatee, embellezca y valide datos JSON al instante. Perfecto para desarrolladores y pruebas de API.',
            'faq' => [
                [
                    'question' => '¿Qué es JSON?',
                    'answer' => 'JSON (JavaScript Object Notation) es un formato ligero de intercambio de datos que es fácil de leer y escribir para humanos y fácil de analizar y generar para máquinas.',
                ],
                [
                    'question' => '¿Cómo uso el Formateador JSON?',
                    'answer' => 'Simplemente pegue sus datos JSON en el campo de entrada y haga clic en el botón "Formatear". La herramienta formateará y validará automáticamente su JSON.',
                ],
                [
                    'question' => '¿Mis datos están seguros?',
                    'answer' => '¡Sí! Todo el formateo se realiza del lado del cliente en su navegador. Sus datos nunca salen de su computadora.',
                ],
            ],
            'use_cases' => [
                [
                    'title' => 'Formateo de Respuestas de API',
                    'description' => 'Formatee respuestas de API para hacerlas más legibles durante el desarrollo y depuración.',
                ],
                [
                    'title' => 'Archivos de Configuración',
                    'description' => 'Valide y formatee archivos de configuración JSON para aplicaciones.',
                ],
                [
                    'title' => 'Validación de Datos',
                    'description' => 'Valide rápidamente la sintaxis JSON antes de usarla en sus aplicaciones.',
                ],
                [
                    'title' => 'Aprendizaje y Educación',
                    'description' => 'Excelente para estudiantes que aprenden sobre estructura y sintaxis JSON.',
                ],
            ],
        ]);
    }
}
