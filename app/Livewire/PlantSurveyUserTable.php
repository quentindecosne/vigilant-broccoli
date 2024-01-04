<?php

namespace App\Livewire;

use App\Models\Survey;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Rules\Rule;
use PowerComponents\LivewirePowerGrid\Rules\RuleActions;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class PlantSurveyUserTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public Survey $survey;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),

            // Header::make()
            //     ->showSearchInput(),
            //     // ->withoutLoading()
            //     // ->showToggleColumns()
            //     // ->includeViewOnTop('project.datatable-header'),

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),

            Responsive::make(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Eloquent, Query Builder or Collection
    |
    */

    /**
     * PowerGrid datasource.
     */
    public function datasource(): Builder
    {

        return DB::table('plant_survey_user')
            ->join('users', 'users.id', '=', 'plant_survey_user.user_id')
            ->leftJoin('plants', 'plants.id', '=', 'plant_survey_user.plant_id')
            ->where('plant_survey_user.survey_id', '=', $this->survey->id)
            ->orderBy('plant_survey_user.plant_id')
            ->orderBy('plant_survey_user.user_id')
            ->groupBy('plant_survey_user.plant_id')
            ->select([
                'plants.family_name',
                'plants.botanical_name',
                'users.name as participant',
                'plant_survey_user.id as id',
                'plant_survey_user.plant_id as plant_id',
                DB::raw('group_concat(plant_survey_user.number_present) as number_present'),
                DB::raw('group_concat(plant_survey_user.occurrence) as occurrence'),
                DB::raw('group_concat(plant_survey_user.regeneration) as regeneration'),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('plant_id')
            ->addColumn('participant')
            ->addColumn('family_name')
            ->addColumn('botanical_name')
            ->addColumn('number_present')
            ->addColumn('occurrence')
            ->addColumn('regeneration');
        // // ->addColumn('note')
        // ->addColumn('created_at_formatted', fn ($model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
        // ->addColumn('updated_at_formatted', fn ($model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Plant id', 'plant_id'),
            Column::make('Participant', 'participant'),
            Column::make('Family', 'family_name'),
            Column::make('Botanical', 'botanical_name'),
            Column::make('Number present', 'number_present'),
            Column::make('Occurrence', 'occurrence'),
            Column::make('Regeneration', 'regeneration'),

            // Column::make('Note', 'note')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Created at', 'created_at_formatted', 'created_at')
            //     ->sortable(),

            // Column::make('Updated at', 'updated_at_formatted', 'updated_at')
            //     ->sortable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
