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

/* catalog/view/template/common/currency.twig */
class __TwigTemplate_426276980c5c30d4625de40fd490b5d3 extends Template
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
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["currencies"] ?? null)) > 1)) {
            // line 2
            yield "  <form id=\"form-currency\" action=\"";
            yield ($context["action"] ?? null);
            yield "\" method=\"post\" data-oc-toggle=\"ajax\">
    <div class=\"dropdown\"><a href=\"#\" data-bs-toggle=\"dropdown\" class=\"dropdown-toggle\">";
            // line 3
            if (($context["symbol_left"] ?? null)) {
                yield "<strong>";
                yield ($context["symbol_left"] ?? null);
                yield "</strong>";
            } elseif (($context["symbol_right"] ?? null)) {
                yield "<strong>";
                yield ($context["symbol_right"] ?? null);
                yield "</strong>";
            }
            yield " <span class=\"d-none d-md-inline\">";
            yield ($context["text_currency"] ?? null);
            yield "</span> <i class=\"fa-solid fa-caret-down\"></i></a>
      <ul class=\"dropdown-menu\">
        ";
            // line 5
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["currencies"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
                // line 6
                yield "          ";
                if (CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "symbol_left", [], "any", false, false, false, 6)) {
                    // line 7
                    yield "            <li><a href=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 7);
                    yield "\" class=\"dropdown-item\">";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "symbol_left", [], "any", false, false, false, 7);
                    yield " ";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "title", [], "any", false, false, false, 7);
                    yield "</a></li>
          ";
                } else {
                    // line 9
                    yield "            <li><a href=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 9);
                    yield "\" class=\"dropdown-item\">";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "symbol_right", [], "any", false, false, false, 9);
                    yield " ";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["currency"], "title", [], "any", false, false, false, 9);
                    yield "</a></li>
          ";
                }
                // line 11
                yield "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['currency'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 12
            yield "      </ul>
    </div>
    <input type=\"hidden\" name=\"code\" value=\"\"/>
    <input type=\"hidden\" name=\"redirect\" value=\"";
            // line 15
            yield ($context["redirect"] ?? null);
            yield "\"/>
  </form>
";
        }
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "catalog/view/template/common/currency.twig";
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
        return array (  102 => 15,  97 => 12,  91 => 11,  81 => 9,  71 => 7,  68 => 6,  64 => 5,  49 => 3,  44 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% if currencies|length > 1 %}
  <form id=\"form-currency\" action=\"{{ action }}\" method=\"post\" data-oc-toggle=\"ajax\">
    <div class=\"dropdown\"><a href=\"#\" data-bs-toggle=\"dropdown\" class=\"dropdown-toggle\">{% if symbol_left %}<strong>{{ symbol_left }}</strong>{% elseif symbol_right %}<strong>{{ symbol_right }}</strong>{% endif %} <span class=\"d-none d-md-inline\">{{ text_currency }}</span> <i class=\"fa-solid fa-caret-down\"></i></a>
      <ul class=\"dropdown-menu\">
        {% for currency in currencies %}
          {% if currency.symbol_left %}
            <li><a href=\"{{ currency.code }}\" class=\"dropdown-item\">{{ currency.symbol_left }} {{ currency.title }}</a></li>
          {% else %}
            <li><a href=\"{{ currency.code }}\" class=\"dropdown-item\">{{ currency.symbol_right }} {{ currency.title }}</a></li>
          {% endif %}
        {% endfor %}
      </ul>
    </div>
    <input type=\"hidden\" name=\"code\" value=\"\"/>
    <input type=\"hidden\" name=\"redirect\" value=\"{{ redirect }}\"/>
  </form>
{% endif %}
", "catalog/view/template/common/currency.twig", "C:\\laragon\\www\\candyfandy\\catalog\\view\\template\\common\\currency.twig");
    }
}
