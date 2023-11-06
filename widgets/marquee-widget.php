<?php
if (!defined("ABSPATH")) {
   exit(); // Exit if accessed directly.
}

class Elementor_Marquee_Widget extends \Elementor\Widget_Base
{
   public function get_style_depends()
   {
      return ["widget-style"];
   }

   // Your widget's name,
   public function get_name()
   {
      return "oembed";
   }

   // Your widget's title,
   public function get_title()
   {
      return esc_html__("Marquee Widget", "marquee-widget");
   }

   // Your widget's icon,
   public function get_icon()
   {
      return "eicon-animation-text";
   }

   // Your widget's category
   public function get_categories()
   {
      return ["basic"];
   }

   // Your widget's Keywords
   public function get_keywords()
   {
      return ["marquee", "text"];
   }

   /**
    * Register Marquee widget controls.
    *
    * Add input fields to allow the user to customize the widget settings.
    *
    * @since 1.0.0
    * @access protected
    */
   protected function register_controls()
   {
      // ----------- Content Section ------------
      $this->start_controls_section("content_section", [
         "label" => esc_html__("Content", "marquee-widget"),
         "tab"   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]);

      //  Heading-text
      $this->add_control("title", [
         "label"       => "Title",
         "type"        => \Elementor\Controls_Manager::TEXTAREA,
         "Default"     => "Your Title or a long text",
         "placeholder" => "Your Title or a long text",
      ]);

      //  HTML tag
      $this->add_control("html_tag", [
         "label"   => "HTML Tag",
         "type"    => \Elementor\Controls_Manager::SELECT,
         "default" => "h2",
         "options" => [
            "h1"   => "H1",
            "h2"   => "H2",
            "h3"   => "H3",
            "h4"   => "H4",
            "h5"   => "H5",
            "h6"   => "H6",
            "span" => "span",
            "p"    => "p",
            "a"    => "a",
         ],
      ]);

      //  Link
      $this->add_control("link", [
         "label"       => "Link",
         "type"        => \Elementor\Controls_Manager::URL,
         "placeholder" => "https://example.com",
         "default"     => [
            "url" => "",
         ],
         "condition"   => [
            "html_tag" => "a",
         ],
      ]);

      $this->end_controls_section();

      $this->start_controls_section("Speed_section", [
         "label" => esc_html__("Speed Control", "textdomain"),
         "tab"   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]);

      $this->add_control("animation_speed", [
         "label"     => esc_html__("Animation Speed", "marquee-widget"),
         "type"      => \Elementor\Controls_Manager::SLIDER,
         "range"     => [
            "s" => [
               "min" => 1,
               "max" => 50,
            ],
         ],
         "default"   => [
            "unit" => "s",
            "size" => 26,
            // Default animation speed
         ],
         "selectors" => [
            "{{WRAPPER}} .marquee .marquee_text" => "animation-duration: {{SIZE}}{{UNIT}};",
         ],
      ]);

      $this->add_control("animation_type", [
         "label"   => esc_html__("Animation Type", "marquee-widget"),
         "type"    => \Elementor\Controls_Manager::SELECT,
         "default" => "marquee-right-left",
         "options" => [
            "marquee-right-left" => esc_html__("Right to Left", "marquee-widget"),
            "marquee-left-right" => esc_html__("Left to Right", "marquee-widget"),
         ],
      ]);

      $this->end_controls_section();

      $this->start_controls_section("style_section", [
         "label" => esc_html__("Style", "marquee-widget"),
         "tab"   => \Elementor\Controls_Manager::TAB_STYLE,
      ]);

      $this->add_control("text_color", [
         "label"     => esc_html__("Text Color", "marquee-widget"),
         "type"      => \Elementor\Controls_Manager::COLOR,
         "selectors" => [
            "{{WRAPPER}} .marquee_text " => "color: {{VALUE}};",
         ],
      ]);

      $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
         "name"     => "typography",
         "label"    => esc_html__("Typography", "marquee-widget"),
         "selector" => "{{WRAPPER}} .marquee .marquee_text",
      ]);

      $this->add_control("background_color", [
         "label"     => esc_html__("Background Color", "marquee-widget"),
         "type"      => \Elementor\Controls_Manager::COLOR,
         "selectors" => [
            "{{WRAPPER}} .marquee" => "background-color: {{VALUE}};",
         ],
         "separator" => "after",
      ]);

      $this->add_control("padding", [
         "label"      => esc_html__("Padding", "marquee-widget"),
         "type"       => \Elementor\Controls_Manager::DIMENSIONS,
         "size_units" => ["px", "em", "rem", "%"],
         "selectors"  => [
            "{{WRAPPER}} .marquee" => "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
         ],
         "separator"  => "after",
      ]);

      $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
         "name"     => "border",
         "selector" => "{{WRAPPER}} .marquee",
      ]);

      $this->end_controls_section();
   }

   // What your widget displays on the front-end
   protected function render()
   {
      $settings       = $this->get_settings_for_display();
      $title          = $settings["title"];
      $html_tag       = $settings["html_tag"];
      $animation_type = $settings["animation_type"];

      // echo "<style> .marquee {--_animation-type: " . $animation_type . ";} </style>";

      if ($html_tag === "a") {
         $link = $settings["link"]["url"];
      } else {
         $link = "";
      }

      echo '<div class="marquee" style="--_anim-direct: ' . $animation_type . ';">';
      echo "<" . $html_tag . ' class="marquee_text">';
      if (!empty($link)) {
         echo '<a href="' . $link . '">' . $title . "</a>";
      } else {
         echo $title;
      }
      echo "</" . $html_tag . ">";
      echo "</div>";
   }
}
