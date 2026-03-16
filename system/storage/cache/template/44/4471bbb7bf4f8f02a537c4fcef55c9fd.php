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

/* catalog/view/template/common/cart.twig */
class __TwigTemplate_44a841301c0ea5437e9035a6588fbc2a extends Template
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
        yield "<div class=\"dropdown d-grid\">
  <button type=\"button\" data-bs-toggle=\"dropdown\" class=\"btn btn-lg btn-dark d-block dropdown-toggle\"><i class=\"fa-solid fa-cart-shopping\"></i> ";
        // line 2
        yield ($context["text_items"] ?? null);
        yield "</button>
  <ul class=\"dropdown-menu dropdown-menu-end p-2\">
    ";
        // line 4
        if (($context["products"] ?? null)) {
            // line 5
            yield "      <li>
        <table class=\"table table-striped mb-2\">
          ";
            // line 7
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["products"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 8
                yield "            <tr>
              <td class=\"text-center w-25\">";
                // line 9
                if (CoreExtension::getAttribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 9)) {
                    yield "<a href=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 9);
                    yield "\"><img src=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 9);
                    yield "\" alt=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 9);
                    yield "\" title=\"";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 9);
                    yield "\" class=\"img-thumbnail\"/></a>";
                }
                yield "</td>
              <td><a href=\"";
                // line 10
                yield CoreExtension::getAttribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 10);
                yield "\">";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 10);
                yield "</a>
                <ul class=\"list-unstyled mb-0\">
                  <li>
                    <small> - ";
                // line 13
                yield ($context["text_model"] ?? null);
                yield ": ";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["product"], "model", [], "any", false, false, false, 13);
                yield "</small>
                  </li>
                  ";
                // line 15
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "option", [], "any", false, false, false, 15));
                foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                    // line 16
                    yield "                    <li>
                      <small> - ";
                    // line 17
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 17);
                    yield ": ";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 17);
                    yield "</small>
                    </li>
                  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['option'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 20
                yield "                  ";
                if (CoreExtension::getAttribute($this->env, $this->source, $context["product"], "subscription", [], "any", false, false, false, 20)) {
                    // line 21
                    yield "                    <li>
                      <small> - ";
                    // line 22
                    yield ($context["text_subscription"] ?? null);
                    yield ": ";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["product"], "subscription", [], "any", false, false, false, 22);
                    yield "</small>
                    </li>
                  ";
                }
                // line 25
                yield "                  ";
                if (CoreExtension::getAttribute($this->env, $this->source, $context["product"], "reward", [], "any", false, false, false, 25)) {
                    // line 26
                    yield "                    <li>
                      <small> - ";
                    // line 27
                    yield ($context["text_points"] ?? null);
                    yield ": ";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["product"], "reward", [], "any", false, false, false, 27);
                    yield "</small>
                    </li>
                  ";
                }
                // line 30
                yield "                </ul>
              </td>
              <td class=\"text-end text-nowrap\">x ";
                // line 32
                yield CoreExtension::getAttribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 32);
                yield "</td>
              <td class=\"text-end\">";
                // line 33
                yield CoreExtension::getAttribute($this->env, $this->source, $context["product"], "total", [], "any", false, false, false, 33);
                yield "</td>
              <td class=\"text-end\">
                <form action=\"";
                // line 35
                yield ($context["remove"] ?? null);
                yield "\" method=\"post\" data-oc-toggle=\"ajax\" data-oc-load=\"";
                yield ($context["list"] ?? null);
                yield "\" data-oc-target=\"#cart\">
                  <input type=\"hidden\" name=\"key\" value=\"";
                // line 36
                yield CoreExtension::getAttribute($this->env, $this->source, $context["product"], "cart_id", [], "any", false, false, false, 36);
                yield "\">
                  <button type=\"submit\" data-bs-toggle=\"tooltip\" title=\"";
                // line 37
                yield ($context["button_remove"] ?? null);
                yield "\" class=\"btn btn-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></button>
                </form>
              </td>
            </tr>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['product'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 42
            yield "        </table>
        <div>
          <table class=\"table table-sm table-bordered mb-2\">
            ";
            // line 45
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["totals"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["total"]) {
                // line 46
                yield "              <tr>
                <td class=\"text-end\"><strong>";
                // line 47
                yield CoreExtension::getAttribute($this->env, $this->source, $context["total"], "title", [], "any", false, false, false, 47);
                yield "</strong></td>
                <td class=\"text-end\">";
                // line 48
                yield CoreExtension::getAttribute($this->env, $this->source, $context["total"], "text", [], "any", false, false, false, 48);
                yield "</td>
              </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['total'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 51
            yield "          </table>
          <p class=\"text-end\"><a href=\"";
            // line 52
            yield ($context["cart"] ?? null);
            yield "\"><strong><i class=\"fa-solid fa-cart-shopping\"></i> ";
            yield ($context["text_cart"] ?? null);
            yield "</strong></a>&nbsp;&nbsp;&nbsp;<a href=\"";
            yield ($context["checkout"] ?? null);
            yield "\"><strong><i class=\"fa-solid fa-share\"></i> ";
            yield ($context["text_checkout"] ?? null);
            yield "</strong></a></p>
        </div>
      </li>
    ";
        } else {
            // line 56
            yield "      <li class=\"text-center p-4\">";
            yield ($context["text_no_results"] ?? null);
            yield "</li>
    ";
        }
        // line 58
        yield "  </ul>
</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "catalog/view/template/common/cart.twig";
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
        return array (  219 => 58,  213 => 56,  200 => 52,  197 => 51,  188 => 48,  184 => 47,  181 => 46,  177 => 45,  172 => 42,  161 => 37,  157 => 36,  151 => 35,  146 => 33,  142 => 32,  138 => 30,  130 => 27,  127 => 26,  124 => 25,  116 => 22,  113 => 21,  110 => 20,  99 => 17,  96 => 16,  92 => 15,  85 => 13,  77 => 10,  63 => 9,  60 => 8,  56 => 7,  52 => 5,  50 => 4,  45 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"dropdown d-grid\">
  <button type=\"button\" data-bs-toggle=\"dropdown\" class=\"btn btn-lg btn-dark d-block dropdown-toggle\"><i class=\"fa-solid fa-cart-shopping\"></i> {{ text_items }}</button>
  <ul class=\"dropdown-menu dropdown-menu-end p-2\">
    {% if products %}
      <li>
        <table class=\"table table-striped mb-2\">
          {% for product in products %}
            <tr>
              <td class=\"text-center w-25\">{% if product.thumb %}<a href=\"{{ product.href }}\"><img src=\"{{ product.thumb }}\" alt=\"{{ product.name }}\" title=\"{{ product.name }}\" class=\"img-thumbnail\"/></a>{% endif %}</td>
              <td><a href=\"{{ product.href }}\">{{ product.name }}</a>
                <ul class=\"list-unstyled mb-0\">
                  <li>
                    <small> - {{ text_model }}: {{ product.model }}</small>
                  </li>
                  {% for option in product.option %}
                    <li>
                      <small> - {{ option.name }}: {{ option.value }}</small>
                    </li>
                  {% endfor %}
                  {% if product.subscription %}
                    <li>
                      <small> - {{ text_subscription }}: {{ product.subscription }}</small>
                    </li>
                  {% endif %}
                  {% if product.reward %}
                    <li>
                      <small> - {{ text_points }}: {{ product.reward }}</small>
                    </li>
                  {% endif %}
                </ul>
              </td>
              <td class=\"text-end text-nowrap\">x {{ product.quantity }}</td>
              <td class=\"text-end\">{{ product.total }}</td>
              <td class=\"text-end\">
                <form action=\"{{ remove }}\" method=\"post\" data-oc-toggle=\"ajax\" data-oc-load=\"{{ list }}\" data-oc-target=\"#cart\">
                  <input type=\"hidden\" name=\"key\" value=\"{{ product.cart_id }}\">
                  <button type=\"submit\" data-bs-toggle=\"tooltip\" title=\"{{ button_remove }}\" class=\"btn btn-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></button>
                </form>
              </td>
            </tr>
          {% endfor %}
        </table>
        <div>
          <table class=\"table table-sm table-bordered mb-2\">
            {% for total in totals %}
              <tr>
                <td class=\"text-end\"><strong>{{ total.title }}</strong></td>
                <td class=\"text-end\">{{ total.text }}</td>
              </tr>
            {% endfor %}
          </table>
          <p class=\"text-end\"><a href=\"{{ cart }}\"><strong><i class=\"fa-solid fa-cart-shopping\"></i> {{ text_cart }}</strong></a>&nbsp;&nbsp;&nbsp;<a href=\"{{ checkout }}\"><strong><i class=\"fa-solid fa-share\"></i> {{ text_checkout }}</strong></a></p>
        </div>
      </li>
    {% else %}
      <li class=\"text-center p-4\">{{ text_no_results }}</li>
    {% endif %}
  </ul>
</div>", "catalog/view/template/common/cart.twig", "C:\\laragon\\www\\candyfandy\\catalog\\view\\template\\common\\cart.twig");
    }
}
