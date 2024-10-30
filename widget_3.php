<?php
class cbdl_widget_three extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = [
            'description' => __('বাংলাদেশের জেলা ভিত্তিক করোনা তথ্য দেখাতে এটা ব্যাবহার করুন।'),
            'customize_selective_refresh' => true,
        ];
        parent::__construct('corona_districts', __('জেলা তথ্য :: করোনা বাংলাদেশ লাইভ'), $widget_ops);
    }

    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : '';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        echo $args['before_widget']; ?>
<?php if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>
<div class="wrap" id="containerElem">
    <div class="columns">
        <div class="corona-left clogo">
            <div class="virus-logo">
                <h2><small>বাংলাদেশে</small> <br> করোনাভাইরাস </h2>
            </div>
        </div>
        <div class="corona-right">
            <div class="height-100">
                <div class="cases-count">
                    <div class="total-cases">
                        <h5>আক্রান্ত</h5>
                        <h1 id="confirmed"><?php echo cbdl_enToBn(number_format(cbdl_getBNStatsData()[0]->TotalCases)); ?></h1>
                    </div>
                    <div class="recovered-cases">
                        <h5>সুস্থ</h5>
                        <h1 id="recovered"><?php echo cbdl_enToBn(number_format(cbdl_getBNStatsData()[0]->TotalRecovered)); ?></h1>
                    </div>
                    <div class="death-cases">
                        <h5>মৃত্যু </h5>
                        <h1 id="deaths"><?php echo cbdl_enToBn(number_format(cbdl_getBNStatsData()[0]->TotalDeaths)); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="list" id="list">
        <li class="list__item" style="color:#FFF!important;border:none!important;background:transparent!important;">জেলা সমূহের তথ্য</li>
    <?php foreach (cbdl_getBNDistrictsData()->features as $district) : ?>
    <li class="list__item">
            <div>
                <span class="name"><?php echo $district->properties->bnName; ?></span>
                <span class="number"><?php echo cbdl_enToBn(number_format($district->properties->confirmed)); ?></span>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
    <div class="sourcing small" style="text-align: center;">
        ন্যাশনাল কল সেন্টার <strong>৩৩৩</strong> | স্বাস্থ্য বাতায়ন <strong>১৬২৬৩</strong> | আইইডিসিআর <strong>১০৬৫৫</strong> | বিশেষজ্ঞ হেলথ লাইন <strong>০৯৬১১৬৭৭৭৭৭</strong> | সূত্র - <a target="_blank" href="https://utshobit.com">আইইডিসিআর</a> | স্পন্সর - <a target="_blank" href="https://ekotahost.com">একতা হোস্ট</a>
    </div>
</div>
<?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $instance = wp_parse_args((array) $instance, ['title' => '']);
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
