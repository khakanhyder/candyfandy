<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* install/view/template/common/header.twig */
class __TwigTemplate_28aff03c61ab36c2530bbefb2d5e55d4 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
\t<meta charset=\"UTF-8\"/>
\t<title>";
        // line 5
        yield ($context["title"] ?? null);
        yield "</title>
\t<base href=\"";
        // line 6
        yield ($context["base"] ?? null);
        yield "\"/>
\t<link href=\"view/stylesheet/bootstrap.css\" rel=\"stylesheet\" media=\"screen\"/>
\t<link href=\"view/stylesheet/fontawesome/css/all.css\" type=\"text/css\" rel=\"stylesheet\"/>
\t<link href=\"view/stylesheet/stylesheet.css\" type=\"text/css\" rel=\"stylesheet\"/>
\t<script type=\"text/javascript\" src=\"view/javascript/jquery/jquery-3.7.1.min.js\"></script>
\t<script src=\"view/javascript/bootstrap/js/bootstrap.bundle.js\" type=\"text/javascript\"></script>
\t<script src=\"view/javascript/common.js\" type=\"text/javascript\"></script>
</head>
<body>
<div id=\"container\">
\t<header id=\"header\" class=\"navbar navbar-expand-lg navbar-light bg-light\">
\t\t<div class=\"container\"><a href=\"";
        // line 17
        yield ($context["home"] ?? null);
        yield "\" class=\"navbar-brand\"><img src=\"view/image/logo.png\" alt=\"OpenCart\" title=\"OpenCart\"/></a> ";
        yield ($context["language"] ?? null);
        yield "</div>
\t</header>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "install/view/template/common/header.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  66 => 17,  52 => 6,  48 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
\t<meta charset=\"UTF-8\"/>
\t<title>{{ title }}</title>
\t<base href=\"{{ base }}\"/>
\t<link href=\"view/stylesheet/bootstrap.css\" rel=\"stylesheet\" media=\"screen\"/>
\t<link href=\"view/stylesheet/fontawesome/css/all.css\" type=\"text/css\" rel=\"stylesheet\"/>
\t<link href=\"view/stylesheet/stylesheet.css\" type=\"text/css\" rel=\"stylesheet\"/>
\t<script type=\"text/javascript\" src=\"view/javascript/jquery/jquery-3.7.1.min.js\"></script>
\t<script src=\"view/javascript/bootstrap/js/bootstrap.bundle.js\" type=\"text/javascript\"></script>
\t<script src=\"view/javascript/common.js\" type=\"text/javascript\"></script>
</head>
<body>
<div id=\"container\">
\t<header id=\"header\" class=\"navbar navbar-expand-lg navbar-light bg-light\">
\t\t<div class=\"container\"><a href=\"{{ home }}\" class=\"navbar-brand\"><img src=\"view/image/logo.png\" alt=\"OpenCart\" title=\"OpenCart\"/></a> {{ language }}</div>
\t</header>", "install/view/template/common/header.twig", "C:\\laragon\\www\\candyfandy\\install\\view\\template\\common\\header.twig");
    }
}
