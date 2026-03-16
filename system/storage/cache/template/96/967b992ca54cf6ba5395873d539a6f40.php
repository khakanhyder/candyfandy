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

/* catalog/view/template/common/language.twig */
class __TwigTemplate_bef4a86e741dd8abbf3f19b58f404f64 extends Template
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
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["languages"] ?? null)) > 1)) {
            // line 2
            yield "  <form id=\"form-language\" action=\"";
            yield ($context["action"] ?? null);
            yield "\" method=\"post\" data-oc-toggle=\"ajax\">
    <div class=\"dropdown\"><a href=\"#\" data-bs-toggle=\"dropdown\" class=\"dropdown-toggle\"><img src=\"";
            // line 3
            yield ($context["image"] ?? null);
            yield "\" alt=\"";
            yield ($context["name"] ?? null);
            yield "\" title=\"";
            yield ($context["name"] ?? null);
            yield "\"> <span class=\"d-none d-md-inline\">";
            yield ($context["text_language"] ?? null);
            yield "</span> <i class=\"fa-solid fa-caret-down\"></i></a>
      <ul class=\"dropdown-menu\">
        ";
            // line 5
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 6
                yield "          <li><a href=\"";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 6);
                yield "\" class=\"dropdown-item\"><img src=\"";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["language"], "image", [], "any", false, false, false, 6);
                yield "\" alt=\"";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 6);
                yield "\" title=\"";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 6);
                yield "\"/> ";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 6);
                yield "</a></li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['language'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 8
            yield "      </ul>
    </div>
    <input type=\"hidden\" name=\"code\" value=\"\"/>
    <input type=\"hidden\" name=\"redirect\" value=\"";
            // line 11
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
        return "catalog/view/template/common/language.twig";
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
        return array (  86 => 11,  81 => 8,  64 => 6,  60 => 5,  49 => 3,  44 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% if languages|length > 1 %}
  <form id=\"form-language\" action=\"{{ action }}\" method=\"post\" data-oc-toggle=\"ajax\">
    <div class=\"dropdown\"><a href=\"#\" data-bs-toggle=\"dropdown\" class=\"dropdown-toggle\"><img src=\"{{ image }}\" alt=\"{{ name }}\" title=\"{{ name }}\"> <span class=\"d-none d-md-inline\">{{ text_language }}</span> <i class=\"fa-solid fa-caret-down\"></i></a>
      <ul class=\"dropdown-menu\">
        {% for language in languages %}
          <li><a href=\"{{ language.code }}\" class=\"dropdown-item\"><img src=\"{{ language.image }}\" alt=\"{{ language.name }}\" title=\"{{ language.name }}\"/> {{ language.name }}</a></li>
        {% endfor %}
      </ul>
    </div>
    <input type=\"hidden\" name=\"code\" value=\"\"/>
    <input type=\"hidden\" name=\"redirect\" value=\"{{ redirect }}\"/>
  </form>
{% endif %}", "catalog/view/template/common/language.twig", "C:\\laragon\\www\\candyfandy\\catalog\\view\\template\\common\\language.twig");
    }
}
