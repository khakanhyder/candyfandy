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

/* extension/opencart/catalog/view/template/module/banner.twig */
class __TwigTemplate_80b4bab15d7280cf830de26cd9fec346 extends Template
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
        yield "<div id=\"carousel-banner-";
        yield ($context["module"] ?? null);
        yield "\" class=\"carousel slide";
        if ((($context["effect"] ?? null) == "fade")) {
            yield " carousel-fade";
        }
        yield "\" data-bs-ride=\"carousel\">
  ";
        // line 2
        if ((($context["indicators"] ?? null) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::batch(($context["banners"] ?? null), ($context["items"] ?? null))) > 1))) {
            // line 3
            yield "    <div class=\"carousel-indicators\">
      ";
            // line 4
            $context["banner_row"] = 0;
            // line 5
            yield "      ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::batch(($context["banners"] ?? null), ($context["items"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
                // line 6
                yield "        <button type=\"button\" data-bs-target=\"#carousel-banner-";
                yield ($context["module"] ?? null);
                yield "\" data-bs-slide-to=\"";
                yield ($context["banner_row"] ?? null);
                yield "\"";
                if ((($context["banner_row"] ?? null) == 0)) {
                    yield " class=\"active\"";
                }
                yield "></button>
        ";
                // line 7
                $context["banner_row"] = (($context["banner_row"] ?? null) + 1);
                // line 8
                yield "      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['banner'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 9
            yield "    </div>
  ";
        }
        // line 11
        yield "  <div class=\"carousel-inner\">
    ";
        // line 12
        $context["banner_row"] = 0;
        // line 13
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::batch(($context["banners"] ?? null), ($context["items"] ?? null)));
        foreach ($context['_seq'] as $context["_key"] => $context["carousel"]) {
            // line 14
            yield "      <div class=\"carousel-item";
            if ((($context["banner_row"] ?? null) == 0)) {
                yield " active";
            }
            yield "\">
        <div class=\"row justify-content-center\">
          ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["carousel"]);
            foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
                // line 17
                yield "            <div class=\"col-";
                yield Twig\Extension\CoreExtension::round((12 / ($context["items"] ?? null)));
                yield " text-center\">
              ";
                // line 18
                if (CoreExtension::getAttribute($this->env, $this->source, $context["banner"], "link", [], "any", false, false, false, 18)) {
                    // line 19
                    yield "                <a href=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["banner"], "link", [], "any", false, false, false, 19);
                    yield "\"><img src=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["banner"], "image", [], "any", false, false, false, 19);
                    yield "\" alt=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["banner"], "title", [], "any", false, false, false, 19);
                    yield "\" class=\"img-fluid\"/></a>
              ";
                } else {
                    // line 21
                    yield "                <img src=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["banner"], "image", [], "any", false, false, false, 21);
                    yield "\" alt=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["banner"], "title", [], "any", false, false, false, 21);
                    yield "\" class=\"img-fluid\"/>
              ";
                }
                // line 23
                yield "            </div>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['banner'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            yield "        </div>
      </div>
      ";
            // line 27
            $context["banner_row"] = (($context["banner_row"] ?? null) + 1);
            // line 28
            yield "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['carousel'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        yield "  </div>
  ";
        // line 30
        if ((($context["controls"] ?? null) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::batch(($context["banners"] ?? null), ($context["items"] ?? null))) > 1))) {
            // line 31
            yield "    <button type=\"button\" class=\"carousel-control-prev\" data-bs-target=\"#carousel-banner-";
            yield ($context["module"] ?? null);
            yield "\" data-bs-slide=\"prev\"><span class=\"fa-solid fa-chevron-left\"></span></button>
    <button type=\"button\" class=\"carousel-control-next\" data-bs-target=\"#carousel-banner-";
            // line 32
            yield ($context["module"] ?? null);
            yield "\" data-bs-slide=\"next\"><span class=\"fa-solid fa-chevron-right\"></span></button>
  ";
        }
        // line 34
        yield "</div>
<script type=\"text/javascript\"><!--
\$(document).ready(function() {
    new bootstrap.Carousel(document.querySelector('#carousel-banner-";
        // line 37
        yield ($context["module"] ?? null);
        yield "'), {
        ride: 'carousel',
        interval: ";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["interval"] ?? null), "js");
        yield ",
        wrap: true
    });
});
//--></script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "extension/opencart/catalog/view/template/module/banner.twig";
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
        return array (  177 => 39,  172 => 37,  167 => 34,  162 => 32,  157 => 31,  155 => 30,  152 => 29,  146 => 28,  144 => 27,  140 => 25,  133 => 23,  125 => 21,  115 => 19,  113 => 18,  108 => 17,  104 => 16,  96 => 14,  91 => 13,  89 => 12,  86 => 11,  82 => 9,  76 => 8,  74 => 7,  63 => 6,  58 => 5,  56 => 4,  53 => 3,  51 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div id=\"carousel-banner-{{ module }}\" class=\"carousel slide{% if effect == 'fade' %} carousel-fade{% endif %}\" data-bs-ride=\"carousel\">
  {% if indicators and banners|batch(items)|length > 1 %}
    <div class=\"carousel-indicators\">
      {% set banner_row = 0 %}
      {% for banner in banners|batch(items) %}
        <button type=\"button\" data-bs-target=\"#carousel-banner-{{ module }}\" data-bs-slide-to=\"{{ banner_row }}\"{% if banner_row == 0 %} class=\"active\"{% endif %}></button>
        {% set banner_row = banner_row + 1 %}
      {% endfor %}
    </div>
  {% endif %}
  <div class=\"carousel-inner\">
    {% set banner_row = 0 %}
    {% for carousel in banners|batch(items) %}
      <div class=\"carousel-item{% if banner_row == 0 %} active{% endif %}\">
        <div class=\"row justify-content-center\">
          {% for banner in carousel %}
            <div class=\"col-{{ (12 / items)|round }} text-center\">
              {% if banner.link %}
                <a href=\"{{ banner.link }}\"><img src=\"{{ banner.image }}\" alt=\"{{ banner.title }}\" class=\"img-fluid\"/></a>
              {% else %}
                <img src=\"{{ banner.image }}\" alt=\"{{ banner.title }}\" class=\"img-fluid\"/>
              {% endif %}
            </div>
          {% endfor %}
        </div>
      </div>
      {% set banner_row = banner_row + 1 %}
    {% endfor %}
  </div>
  {% if controls and banners|batch(items)|length > 1 %}
    <button type=\"button\" class=\"carousel-control-prev\" data-bs-target=\"#carousel-banner-{{ module }}\" data-bs-slide=\"prev\"><span class=\"fa-solid fa-chevron-left\"></span></button>
    <button type=\"button\" class=\"carousel-control-next\" data-bs-target=\"#carousel-banner-{{ module }}\" data-bs-slide=\"next\"><span class=\"fa-solid fa-chevron-right\"></span></button>
  {% endif %}
</div>
<script type=\"text/javascript\"><!--
\$(document).ready(function() {
    new bootstrap.Carousel(document.querySelector('#carousel-banner-{{ module }}'), {
        ride: 'carousel',
        interval: {{ interval|escape('js') }},
        wrap: true
    });
});
//--></script>
", "extension/opencart/catalog/view/template/module/banner.twig", "C:\\laragon\\www\\candyfandy\\extension\\opencart\\catalog\\view\\template\\module\\banner.twig");
    }
}
