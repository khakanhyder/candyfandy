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

/* catalog/view/template/common/footer.twig */
class __TwigTemplate_1d17e90358c4cfdde70b7ee0189a50cc extends Template
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
        yield "</main>
<footer>
  <div class=\"container\">
    <div class=\"row\">
      ";
        // line 5
        if ((($context["informations"] ?? null) || ($context["blog"] ?? null))) {
            // line 6
            yield "        <div class=\"col-sm-3\">
          <h5>";
            // line 7
            yield ($context["text_information"] ?? null);
            yield "</h5>
          <ul class=\"list-unstyled\">
            ";
            // line 9
            if (($context["blog"] ?? null)) {
                // line 10
                yield "              <li><a href=\"";
                yield ($context["blog"] ?? null);
                yield "\">";
                yield ($context["text_blog"] ?? null);
                yield "</a></li>
            ";
            }
            // line 12
            yield "            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["informations"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
                // line 13
                yield "              <li><a href=\"";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["information"], "href", [], "any", false, false, false, 13);
                yield "\">";
                yield CoreExtension::getAttribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 13);
                yield "</a></li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['information'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            yield "          </ul>
        </div>
      ";
        }
        // line 18
        yield "      <div class=\"col-sm-3\">
        <h5>";
        // line 19
        yield ($context["text_service"] ?? null);
        yield "</h5>
        <ul class=\"list-unstyled\">
          <li><a href=\"";
        // line 21
        yield ($context["contact"] ?? null);
        yield "\">";
        yield ($context["text_contact"] ?? null);
        yield "</a></li>
          <li><a href=\"";
        // line 22
        yield ($context["return"] ?? null);
        yield "\">";
        yield ($context["text_return"] ?? null);
        yield "</a></li>
          ";
        // line 23
        if (($context["gdpr"] ?? null)) {
            // line 24
            yield "            <li><a href=\"";
            yield ($context["gdpr"] ?? null);
            yield "\">";
            yield ($context["text_gdpr"] ?? null);
            yield "</a></li>
          ";
        }
        // line 26
        yield "          <li><a href=\"";
        yield ($context["sitemap"] ?? null);
        yield "\">";
        yield ($context["text_sitemap"] ?? null);
        yield "</a></li>
        </ul>
      </div>
      <div class=\"col-sm-3\">
        <h5>";
        // line 30
        yield ($context["text_extra"] ?? null);
        yield "</h5>
        <ul class=\"list-unstyled\">
          <li><a href=\"";
        // line 32
        yield ($context["manufacturer"] ?? null);
        yield "\">";
        yield ($context["text_manufacturer"] ?? null);
        yield "</a></li>
          ";
        // line 33
        if (($context["affiliate"] ?? null)) {
            // line 34
            yield "            <li><a href=\"";
            yield ($context["affiliate"] ?? null);
            yield "\">";
            yield ($context["text_affiliate"] ?? null);
            yield "</a></li>
          ";
        }
        // line 36
        yield "          <li><a href=\"";
        yield ($context["special"] ?? null);
        yield "\">";
        yield ($context["text_special"] ?? null);
        yield "</a></li>
        </ul>
      </div>
      <div class=\"col-sm-3\">
        <h5>";
        // line 40
        yield ($context["text_account"] ?? null);
        yield "</h5>
        <ul class=\"list-unstyled\">
          <li><a href=\"";
        // line 42
        yield ($context["account"] ?? null);
        yield "\">";
        yield ($context["text_account"] ?? null);
        yield "</a></li>
          <li><a href=\"";
        // line 43
        yield ($context["order"] ?? null);
        yield "\">";
        yield ($context["text_order"] ?? null);
        yield "</a></li>
          <li><a href=\"";
        // line 44
        yield ($context["wishlist"] ?? null);
        yield "\">";
        yield ($context["text_wishlist"] ?? null);
        yield "</a></li>
          <li><a href=\"";
        // line 45
        yield ($context["newsletter"] ?? null);
        yield "\">";
        yield ($context["text_newsletter"] ?? null);
        yield "</a></li>
        </ul>
      </div>
    </div>
    <hr>
    <p>";
        // line 50
        yield ($context["powered"] ?? null);
        yield "</p>
    <!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->
  </div>
</footer>
</div>
";
        // line 58
        yield ($context["cookie"] ?? null);
        yield "
<script src=\"";
        // line 59
        yield ($context["bootstrap"] ?? null);
        yield "\" type=\"text/javascript\"></script>
";
        // line 60
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["scripts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
            // line 61
            yield "  <script src=\"";
            yield CoreExtension::getAttribute($this->env, $this->source, $context["script"], "href", [], "any", false, false, false, 61);
            yield "\" type=\"text/javascript\"></script>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['script'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        yield "</body></html>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "catalog/view/template/common/footer.twig";
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
        return array (  225 => 63,  216 => 61,  212 => 60,  208 => 59,  204 => 58,  193 => 50,  183 => 45,  177 => 44,  171 => 43,  165 => 42,  160 => 40,  150 => 36,  142 => 34,  140 => 33,  134 => 32,  129 => 30,  119 => 26,  111 => 24,  109 => 23,  103 => 22,  97 => 21,  92 => 19,  89 => 18,  84 => 15,  73 => 13,  68 => 12,  60 => 10,  58 => 9,  53 => 7,  50 => 6,  48 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("</main>
<footer>
  <div class=\"container\">
    <div class=\"row\">
      {% if informations or blog %}
        <div class=\"col-sm-3\">
          <h5>{{ text_information }}</h5>
          <ul class=\"list-unstyled\">
            {% if blog %}
              <li><a href=\"{{ blog }}\">{{ text_blog }}</a></li>
            {% endif %}
            {% for information in informations %}
              <li><a href=\"{{ information.href }}\">{{ information.title }}</a></li>
            {% endfor %}
          </ul>
        </div>
      {% endif %}
      <div class=\"col-sm-3\">
        <h5>{{ text_service }}</h5>
        <ul class=\"list-unstyled\">
          <li><a href=\"{{ contact }}\">{{ text_contact }}</a></li>
          <li><a href=\"{{ return }}\">{{ text_return }}</a></li>
          {% if gdpr %}
            <li><a href=\"{{ gdpr }}\">{{ text_gdpr }}</a></li>
          {% endif %}
          <li><a href=\"{{ sitemap }}\">{{ text_sitemap }}</a></li>
        </ul>
      </div>
      <div class=\"col-sm-3\">
        <h5>{{ text_extra }}</h5>
        <ul class=\"list-unstyled\">
          <li><a href=\"{{ manufacturer }}\">{{ text_manufacturer }}</a></li>
          {% if affiliate %}
            <li><a href=\"{{ affiliate }}\">{{ text_affiliate }}</a></li>
          {% endif %}
          <li><a href=\"{{ special }}\">{{ text_special }}</a></li>
        </ul>
      </div>
      <div class=\"col-sm-3\">
        <h5>{{ text_account }}</h5>
        <ul class=\"list-unstyled\">
          <li><a href=\"{{ account }}\">{{ text_account }}</a></li>
          <li><a href=\"{{ order }}\">{{ text_order }}</a></li>
          <li><a href=\"{{ wishlist }}\">{{ text_wishlist }}</a></li>
          <li><a href=\"{{ newsletter }}\">{{ text_newsletter }}</a></li>
        </ul>
      </div>
    </div>
    <hr>
    <p>{{ powered }}</p>
    <!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->
  </div>
</footer>
</div>
{{ cookie }}
<script src=\"{{ bootstrap }}\" type=\"text/javascript\"></script>
{% for script in scripts %}
  <script src=\"{{ script.href }}\" type=\"text/javascript\"></script>
{% endfor %}
</body></html>
", "catalog/view/template/common/footer.twig", "C:\\laragon\\www\\candyfandy\\catalog\\view\\template\\common\\footer.twig");
    }
}
