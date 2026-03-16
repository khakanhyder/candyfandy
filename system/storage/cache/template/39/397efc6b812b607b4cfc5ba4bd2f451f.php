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

/* catalog/view/template/common/menu.twig */
class __TwigTemplate_bb482c8323166e334d508ee371ac0287 extends Template
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
        if (($context["categories"] ?? null)) {
            // line 2
            yield "  <div class=\"container\">
    <nav id=\"menu\" class=\"navbar navbar-expand-lg bg-primary\">
      <div id=\"category\" class=\"d-block d-sm-block d-lg-none\">";
            // line 4
            yield ($context["text_category"] ?? null);
            yield "</div>
      <button type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbar-menu\" class=\"navbar-toggler d-lg-none\"><i class=\"fa-solid fa-bars\"></i></button>
      <div id=\"navbar-menu\" class=\"collapse navbar-collapse\">
        <ul class=\"nav navbar-nav\">
          ";
            // line 8
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["categories"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 9
                yield "            ";
                if (CoreExtension::getAttribute($this->env, $this->source, $context["category"], "children", [], "any", false, false, false, 9)) {
                    // line 10
                    yield "              ";
                    $context["total"] = Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["category"], "children", [], "any", false, false, false, 10));
                    // line 11
                    yield "              ";
                    if ((($context["total"] ?? null) > 20)) {
                        // line 12
                        yield "                ";
                        $context["batch"] = Twig\Extension\CoreExtension::round((($context["total"] ?? null) / 4), 0, "ceil");
                        // line 13
                        yield "                ";
                        $context["column"] = 4;
                        // line 14
                        yield "              ";
                    } else {
                        // line 15
                        yield "                ";
                        $context["batch"] = 5;
                        // line 16
                        yield "                ";
                        $context["column"] = Twig\Extension\CoreExtension::round((($context["total"] ?? null) / 5), 0, "ceil");
                        // line 17
                        yield "              ";
                    }
                    // line 18
                    yield "              <li class=\"nav-item dropdown\"><a href=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 18);
                    yield "\" class=\"nav-link dropdown-toggle\" data-bs-toggle=\"dropdown\">";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 18);
                    yield "</a>
                <div class=\"dropdown-menu dropdown-column-";
                    // line 19
                    yield ($context["column"] ?? null);
                    yield "\">
                  <div class=\"dropdown-inner\">
                    ";
                    // line 21
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::batch(CoreExtension::getAttribute($this->env, $this->source, $context["category"], "children", [], "any", false, false, false, 21), ($context["batch"] ?? null)));
                    foreach ($context['_seq'] as $context["_key"] => $context["children"]) {
                        // line 22
                        yield "                      <ul class=\"list-unstyled\">
                        ";
                        // line 23
                        $context['_parent'] = $context;
                        $context['_seq'] = CoreExtension::ensureTraversable($context["children"]);
                        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                            // line 24
                            yield "                          <li><a href=\"";
                            yield CoreExtension::getAttribute($this->env, $this->source, $context["child"], "href", [], "any", false, false, false, 24);
                            yield "\" class=\"dropdown-item\">";
                            yield CoreExtension::getAttribute($this->env, $this->source, $context["child"], "name", [], "any", false, false, false, 24);
                            yield "</a></li>
                        ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_key'], $context['child'], $context['_parent']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 26
                        yield "                      </ul>
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['children'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 28
                    yield "                  </div>
                  <ul class=\"list-unstyled\">
                    <li>
                      <hr class=\"dropdown-divider\">
                    </li>
                    <li><a href=\"";
                    // line 33
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 33);
                    yield "\" class=\"dropdown-item\">";
                    yield ($context["text_all"] ?? null);
                    yield " ";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 33);
                    yield "</a></li>
                  </ul>
                </div>
              </li>
            ";
                } else {
                    // line 38
                    yield "              <li class=\"nav-item\"><a href=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 38);
                    yield "\" class=\"dropdown-item\">";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 38);
                    yield "</a></li>
            ";
                }
                // line 40
                yield "          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['category'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            yield "        </ul>
      </div>
    </nav>
  </div>
";
        }
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "catalog/view/template/common/menu.twig";
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
        return array (  160 => 41,  154 => 40,  146 => 38,  134 => 33,  127 => 28,  120 => 26,  109 => 24,  105 => 23,  102 => 22,  98 => 21,  93 => 19,  86 => 18,  83 => 17,  80 => 16,  77 => 15,  74 => 14,  71 => 13,  68 => 12,  65 => 11,  62 => 10,  59 => 9,  55 => 8,  48 => 4,  44 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% if categories %}
  <div class=\"container\">
    <nav id=\"menu\" class=\"navbar navbar-expand-lg bg-primary\">
      <div id=\"category\" class=\"d-block d-sm-block d-lg-none\">{{ text_category }}</div>
      <button type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbar-menu\" class=\"navbar-toggler d-lg-none\"><i class=\"fa-solid fa-bars\"></i></button>
      <div id=\"navbar-menu\" class=\"collapse navbar-collapse\">
        <ul class=\"nav navbar-nav\">
          {% for category in categories %}
            {% if category.children %}
              {% set total = category.children|length %}
              {% if total > 20 %}
                {% set batch = (total / 4)|round(0, 'ceil') %}
                {% set column = 4 %}
              {% else %}
                {% set batch = 5 %}
                {% set column = (total / 5)|round(0, 'ceil') %}
              {% endif %}
              <li class=\"nav-item dropdown\"><a href=\"{{ category.href }}\" class=\"nav-link dropdown-toggle\" data-bs-toggle=\"dropdown\">{{ category.name }}</a>
                <div class=\"dropdown-menu dropdown-column-{{ column }}\">
                  <div class=\"dropdown-inner\">
                    {% for children in category.children|batch(batch) %}
                      <ul class=\"list-unstyled\">
                        {% for child in children %}
                          <li><a href=\"{{ child.href }}\" class=\"dropdown-item\">{{ child.name }}</a></li>
                        {% endfor %}
                      </ul>
                    {% endfor %}
                  </div>
                  <ul class=\"list-unstyled\">
                    <li>
                      <hr class=\"dropdown-divider\">
                    </li>
                    <li><a href=\"{{ category.href }}\" class=\"dropdown-item\">{{ text_all }} {{ category.name }}</a></li>
                  </ul>
                </div>
              </li>
            {% else %}
              <li class=\"nav-item\"><a href=\"{{ category.href }}\" class=\"dropdown-item\">{{ category.name }}</a></li>
            {% endif %}
          {% endfor %}
        </ul>
      </div>
    </nav>
  </div>
{% endif %}
", "catalog/view/template/common/menu.twig", "C:\\laragon\\www\\candyfandy\\catalog\\view\\template\\common\\menu.twig");
    }
}
