<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Forms\Set;
use Filament\Infolists\Components\Group as ComponentsGroup;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

use function Laravel\Prompts\select;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Product Information')->schema([
                    TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->afterStateUpdated(function(string $operation, $state, Set $set){
                                if($operation !== 'create'){
                                    return;}
                                $set('slug', Str::slug($state));
                            }),

                         TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->dehydrated()
                        ->unique(Product::class, 'slug', ignoreRecord: true),

                        MarkdownEditor::make('description')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products'),
                    ])->columns(2),
                    section::make('image')->schema([
                        FileUpload::make('image')
                            ->multiple()
                            ->directory('products')
                            ->reorderable()
                            ->maxFiles(5),
                    ])
                ])->columnSpan(2),
                
                Group::make()->schema([
                    section::make('price')->schema([
                        TextInput::make('price')
                        ->numeric()
                        ->required()
                        ->prefix('Rp'),
                    ]),
                    section::make('association')->schema([
                        Select::make('category_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('category', 'name'),

                            
                            Select::make('brand_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('brand', 'name'),
                    ]),

                    Section::make('status')->schema([
                        Toggle::make('in_stock')
                        ->required()
                        ->default(true),

                        Toggle::make('is_active')
                        ->required()
                        ->default(true),

                        Toggle::make('is_featured')
                        ->required()
                        ->default(true),

                        Toggle::make('on_sale')
                        ->required()
                        ->default(true),
                    ])
                ])->columnSpan(1)
                
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
