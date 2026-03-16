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

/* install/view/template/install/step_1.twig */
class __TwigTemplate_c2e901654da42bab02e4bb05b64de036 extends Template
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
        yield ($context["header"] ?? null);
        yield "
<div id=\"content\">
\t<div class=\"page-header\">
\t\t<div class=\"container\">
\t\t\t<h1>";
        // line 5
        yield ($context["heading_title"] ?? null);
        yield "</h1>
\t\t</div>
\t</div>
\t<div class=\"container\">
\t\t<div class=\"card\">
\t\t\t<div class=\"card-header\"><i class=\"fab fa-opencart\"></i>&nbsp;&nbsp;&nbsp;";
        // line 10
        yield ($context["text_step_1"] ?? null);
        yield "</div>
\t\t\t<div class=\"card-body\">
\t\t\t\t<div class=\"form-control\" style=\"max-height: 300px; overflow-y: scroll;\">";
        // line 12
        yield ($context["text_terms"] ?? null);
        yield "</div>
\t\t\t\t<div class=\"row mt-3\">
\t\t\t\t\t<div class=\"col text-end\"><a href=\"";
        // line 14
        yield ($context["continue"] ?? null);
        yield "\" class=\"btn btn-primary\">";
        yield ($context["button_continue"] ?? null);
        yield "</a></div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
        // line 20
        yield ($context["footer"] ?? null);
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "install/view/template/install/step_1.twig";
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
        return array (  78 => 20,  67 => 14,  62 => 12,  57 => 10,  49 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{{ header }}
<div id=\"content\">
\t<div class=\"page-header\">
\t\t<div class=\"container\">
\t\t\t<h1>{{ heading_title }}</h1>
\t\t</div>
\t</div>
\t<div class=\"container\">
\t\t<div class=\"card\">
\t\t\t<div class=\"card-header\"><i class=\"fab fa-opencart\"></i>&nbsp;&nbsp;&nbsp;{{ text_step_1 }}</div>
\t\t\t<div class=\"card-body\">
\t\t\t\t<div class=\"form-control\" style=\"max-height: 300px; overflow-y: scroll;\">{{ text_terms }}</div>
\t\t\t\t<div class=\"row mt-3\">
\t\t\t\t\t<div class=\"col text-end\"><a href=\"{{ continue }}\" class=\"btn btn-primary\">{{ button_continue }}</a></div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
{{ footer }}", "install/view/template/install/step_1.twig", "C:\\laragon\\www\\candyfandy\\install\\view\\template\\install\\step_1.twig");
    }
}
