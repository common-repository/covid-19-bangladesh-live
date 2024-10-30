<?php

class cbdl_widget_one extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = [
            'description' => __('বাংলাদেশের করোনা তথ্য দেখাতে এটা ব্যাবহার করুন।'),
            'customize_selective_refresh' => true,
        ];
        parent::__construct('corona_bd', __('বাংলাদেশের তথ্য :: করোনা বাংলাদেশ লাইভ'), $widget_ops);
    }

    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : '';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        echo $args['before_widget']; ?>
<div class="statistics_bd">
    <?php if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>
    <div class="body body_bd">
        <h3>সর্বমোট</h3>
        <div class="content">
            <div class="text">আক্রান্ত</div>
            <div id="confirmed" class="number"><?php echo cbdl_enToBn(number_format(cbdl_getBNStatsData()[0]->TotalCases)); ?>
            </div>
        </div>
        <div class="content">
            <div class="text">সুস্থ</div>
            <div id="recovered" class="number"><?php echo cbdl_enToBn(number_format(cbdl_getBNStatsData()[0]->TotalRecovered)); ?>
            </div>
        </div>
        <div class="content">
            <div class="text">মৃত্যু</div>
            <div id="deaths" class="number death"><?php echo cbdl_enToBn(number_format(cbdl_getBNStatsData()[0]->TotalDeaths)); ?>
            </div>
        </div>
        <div class="content">
            <div class="number sutro">
                সূত্র: <a target="_blank" href="https://utshobit.com">আইইডিসিআর</a>
            </div>
        </div>
    </div>
    <div class="body body_world">
        <h3>সর্বশেষ</h3>
        <div class="content">
            <div class="text">আক্রান্ত</div>
            <div id="wconfirmed" class="number"><?php echo cbdl_enToBn(number_format(cbdl_getBNStatsData()[0]->NewCases)); ?>
            </div>
        </div>
        <div class="content">
            <div class="text">সুস্থ</div>
            <div id="wrecovered" class="number"><?php echo cbdl_enToBn(number_format(cbdl_getBNStatsData()[0]->NewRecovered)); ?>
            </div>
        </div>
        <div class="content">
            <div class="text">মৃত্যু</div>
            <div id="wdeaths" class="number death"><?php echo cbdl_enToBn(number_format(cbdl_getBNStatsData()[0]->NewDeaths)); ?>
            </div>
        </div>
        <div class="content">
            <div class="number sutro">
                স্পন্সর: <a target="_blank" href="https://ekotahost.com">একতা হোস্ট</a>
            </div>
        </div>
    </div>
</div>
<?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $instance = wp_parse_args((array) $instance, ['title' => 'বাংলাদেশে করোনা ভাইরাস']);
        $title = $instance['title']; ?>
<p><label
        for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat"
            id="<?php echo $this->get_field_id('title'); ?>"
            name="<?php echo $this->get_field_name('title'); ?>"
            type="text"
            value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $new_instance = wp_parse_args((array) $new_instance, ['title' => '']);
        $instance['title'] = sanitize_text_field($new_instance['title']);
        return $instance;
    }
}
