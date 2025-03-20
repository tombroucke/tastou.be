<?php

namespace Tastou\OptionsPages;

use StoutLogic\AcfBuilder\FieldsBuilder;
use Tastou\Abstracts\OptionsPage as AbstractsOptionsPage;
use Tastou\Contracts\OptionsPage;
use TastouSocialMedia as SocialMedia;

class General extends AbstractsOptionsPage implements OptionsPage
{
    protected string $slug = 'tastou-settings';

    protected string $title = 'General Settings';

    protected string $menuTitle = 'General Settings';

    public function __construct()
    {
        $this->title = __('General Settings', 'tastou');
        $this->menuTitle = __('General Settings', 'tastou');
    }

    protected function fields(FieldsBuilder $fieldsBuilder): FieldsBuilder
    {
        $fieldsBuilder = $this->addContactInformation($fieldsBuilder);
        $fieldsBuilder = $this->addSocialMedia($fieldsBuilder);
        // $fieldsBuilder = $this->addOpeningHours($fieldsBuilder);
        // $fieldsBuilder = $this->addNewsletter($fieldsBuilder);

        return $fieldsBuilder;
    }

    private function addSocialMedia(FieldsBuilder $settings): FieldsBuilder
    {
        $settings
            ->addTab('social_media', [
                'label' => __('Social media URL\'s', 'tastou'),
            ]);

        $channels = SocialMedia::allChannels();

        $channels->each(function ($channel, $key) use ($settings) {
            $settings
                ->addUrl('social_media_'.$key, [
                    'label' => $channel['label'],
                ]);
        });

        return $settings;
    }

    private function addContactInformation(FieldsBuilder $settings): FieldsBuilder
    {
        $settings
            ->addTab('contact_information', [
                'label' => __('Contact information', 'tastou'),
            ]);

        $fields = collect([
            'company' => __('Company', 'tastou'),
            'street' => __('Street', 'tastou'),
            'street_number' => __('Number', 'tastou'),
            'postcode' => __('Postcode', 'tastou'),
            'city' => __('City', 'tastou'),
            'country' => __('Country', 'tastou'),
            'phone' => __('Phone', 'tastou'),
            'email' => __('Email', 'tastou'),
            'vat_number' => __('VAT number', 'tastou'),
        ]);

        $fields->each(function ($label, $key) use ($settings) {
            $settings
                ->addText('contact_information_'.$key, [
                    'label' => $label,
                ]);
        });

        return $settings;
    }

    private function addOpeningHours(FieldsBuilder $settings): FieldsBuilder
    {
        $settings
            ->addTab('opening_hours', [
                'label' => __('Opening hours', 'tastou'),
            ]);
        $days = app()->make('tastou.locale')->weekDays();
        $days->each(function ($day, $key) use ($settings) {
            $settings
                ->addRepeater('opening_hours_'.$key, [
                    'label' => ucfirst($day),
                ])
                ->addTimePicker('from', [
                    'label' => __('From', 'tastou'),
                    'display_format' => 'H:i',
                    'return_format' => 'H:i',
                    'default_value' => '09:00',
                ])
                ->addTimePicker('to', [
                    'label' => __('To', 'tastou'),
                    'display_format' => 'H:i',
                    'return_format' => 'H:i',
                    'default_value' => '17:00',
                ])
                ->endRepeater();
        });

        return $settings;
    }

    private function addNewsletter(FieldsBuilder $settings): FieldsBuilder
    {
        $settings
            ->addTab('newsletter', [
                'label' => __('Newsletter', 'tastou'),
            ]);
        $settings
            ->addTextarea('newsletter_signup_form', [
                'label' => __('Newsletter signup form', 'tastou'),
                'rows' => 40,
                'instructions' => __('Enter the signup form code. You can use the [newsletter-signup-form] shortcode to display the signup form.', 'tastou'),
            ]);

        return $settings;
    }
}
