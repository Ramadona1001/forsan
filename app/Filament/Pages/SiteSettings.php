<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    public static function getNavigationLabel(): string
    {
        return __('filament.pages.site_settings.nav_label');
    }

    protected static ?string $title = null;

    public function getTitle(): string
    {
        return __('filament.pages.site_settings.title');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.settings');
    }
    protected static ?int $navigationSort = 99;
    protected static string $view = 'filament.pages.site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $s = SiteSetting::getSettings();
        if (! $s) {
            $this->data = [];
            return;
        }
        $heading = $s->contact_banner_heading ?? [];
        $address = $s->contact_address ?? [];
        $hours = $s->working_hours ?? [];
        $this->form->fill([
            'contact_banner_heading_ar' => is_array($heading) ? ($heading['ar'] ?? '') : '',
            'contact_banner_heading_en' => is_array($heading) ? ($heading['en'] ?? '') : '',
            'contact_address_ar' => is_array($address) ? ($address['ar'] ?? '') : '',
            'contact_address_en' => is_array($address) ? ($address['en'] ?? '') : '',
            'contact_phone' => $s->contact_phone,
            'contact_whatsapp' => $s->contact_whatsapp,
            'contact_email' => $s->contact_email,
            'working_hours_ar' => is_array($hours) ? ($hours['ar'] ?? '') : '',
            'working_hours_en' => is_array($hours) ? ($hours['en'] ?? '') : '',
            'logo' => $s->logo,
            'favicon' => $s->favicon,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.pages.site_settings.contact_section'))
                    ->schema([
                        Forms\Components\TextInput::make('contact_banner_heading_ar')
                            ->label(__('filament.pages.site_settings.banner_heading') . ' (عربي)')
                            ->maxLength(500)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('contact_banner_heading_en')
                            ->label(__('filament.pages.site_settings.banner_heading') . ' (EN)')
                            ->maxLength(500)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('contact_address_ar')
                            ->label(__('filament.pages.site_settings.address') . ' (عربي)')
                            ->rows(3)
                            ->placeholder('سطر واحد أو أكثر'),
                        Forms\Components\Textarea::make('contact_address_en')
                            ->label(__('filament.pages.site_settings.address') . ' (EN)')
                            ->rows(3),
                        Forms\Components\TextInput::make('contact_phone')
                            ->label(__('filament.fields.phone'))
                            ->tel()
                            ->maxLength(50),
                        Forms\Components\TextInput::make('contact_whatsapp')
                            ->label('واتساب (رقم بدون +)')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('contact_email')
                            ->label(__('filament.fields.email'))
                            ->email()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('working_hours_ar')
                            ->label(__('filament.pages.site_settings.working_hours') . ' (عربي)')
                            ->rows(2),
                        Forms\Components\Textarea::make('working_hours_en')
                            ->label(__('filament.pages.site_settings.working_hours') . ' (EN)')
                            ->rows(2),
                    ])->columns(2),
                Forms\Components\Section::make(__('filament.pages.site_settings.logo_section'))
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->label(__('filament.pages.site_settings.logo'))
                            ->image()
                            ->directory('site')
                            ->nullable(),
                        Forms\Components\FileUpload::make('favicon')
                            ->label(__('filament.pages.site_settings.favicon'))
                            ->image()
                            ->directory('site')
                            ->maxSize(512)
                            ->helperText('يفضل 32×32 أو 16×16 بكسل')
                            ->nullable(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $s = SiteSetting::getSettings();
        if (! $s) {
            $s = new SiteSetting();
        }
        $s->contact_banner_heading = [
            'ar' => $data['contact_banner_heading_ar'] ?? '',
            'en' => $data['contact_banner_heading_en'] ?? '',
        ];
        $s->contact_address = [
            'ar' => $data['contact_address_ar'] ?? '',
            'en' => $data['contact_address_en'] ?? '',
        ];
        $s->contact_phone = $data['contact_phone'] ?? null;
        $s->contact_whatsapp = $data['contact_whatsapp'] ?? null;
        $s->contact_email = $data['contact_email'] ?? null;
        $s->working_hours = [
            'ar' => $data['working_hours_ar'] ?? '',
            'en' => $data['working_hours_en'] ?? '',
        ];
        $s->logo = $data['logo'] ?? null;
        $s->favicon = $data['favicon'] ?? null;
        $s->save();

        Notification::make()
            ->title(__('filament.pages.site_settings.saved'))
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label(__('filament.pages.site_settings.save_btn'))
                ->submit('save'),
        ];
    }
}
