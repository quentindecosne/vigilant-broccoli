<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button,
    Column,
    Exportable,
    Footer,
    Header,
    PowerGrid,
    PowerGridComponent,
    PowerGridColumns,
    Responsive};

final class SurveyMasterTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public int $perPage = 50;
    public array $perPageValues = [50,100,1000];

    public string $survey;

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
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount(),
            Responsive::make()->fixedColumns('family_name', 'botanical_name', Responsive::ACTIONS_COLUMN_NAME)
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
     *
     * @return Builder
     */
    public function datasource(): Builder
    {
        return DB::table('plant_survey_user')->where('plant_survey_user.survey_id','=',$this->survey)
            ->select('plants.family_name','plants.botanical_name', 'plant_survey_user.id', 'plant_survey_user.survey_id', 'plant_survey_user.user_id', 'plant_survey_user.plant_id',
                DB::raw('GROUP_CONCAT(plant_survey_user.occurrence) as occurrence'),
                DB::raw('GROUP_CONCAT(plant_survey_user.regeneration) as regeneration'),
                DB::raw('GROUP_CONCAT(plant_survey_user.number_present) as number_present'),

    )
            ->join('plants', 'plants.id', '=', 'plant_survey_user.plant_id')
                ->groupBy(['plant_survey_user.survey_id', 'plant_survey_user.plant_id']);

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
//            ->addColumn('created_at_formatted', fn ($model) => Carbon::parse($model->created_at)->format('d/m/Y'))
            ->addColumn('id')
            ->addColumn('family_name')
            ->addColumn('botanical_name')
            ->addColumn('number_present_participant', function ($model){
                $present = explode(',',$model->number_present);
                $num_present = "";
                $i = 0;
                $colors = ['teal', 'green', 'amber', 'lime'];
                foreach($present as $num) {
                    $num_present .= "<span class=\"ml-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-".$colors[$i]."-100 text-".$colors[$i]."-800\">".$num."</span>";
                    $i++;
                }
                return $num_present;
            })
            ->addColumn('occurrence_participant', function ($model){
                $occurrences = explode(',',$model->occurrence);
                $colors = ['rare'=> 'sky', 'abundant'=> 'blue', 'occasional'=> 'indigo', 'common'=> 'violet'];
                $data = "";
                foreach($occurrences as $occ) {
                  if ($occ != "")
                      $data .= "<span class=\"ml-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-".$colors[$occ]."-100 text-".$colors[$occ]."-800\">" . $occ . "</span>";
                }
                return $data;
            })
            ->addColumn('plant_id')
            ->addColumn('regeneration_participant', function ($model){
                $regenerations = explode(',',$model->regeneration);
                $colors = ['rare'=> 'rose', 'abundant'=> 'pink', 'occasional'=> 'fuchsia', 'common'=> 'purple'];
                $data = "";
                foreach($regenerations as $reg) {
                  if ($reg != "")
                      $data .= "<span class=\"ml-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-".$colors[$reg]."-100 text-".$colors[$reg]."-800\">" . $reg . "</span>";
                }
                return $data;
            })
            ->addColumn('survey_id');

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
//            Column::make('Created at', 'created_at_formatted', 'created_at')
//                ->sortable(),

            Column::make('Id', 'id')->hidden(),
            Column::make('Family', 'family_name')
                ->sortable()
                ->searchable(),
            Column::make('Botanical', 'botanical_name')
                ->sortable()
                ->searchable(),
            Column::make('Number present', 'number_present_participant', 'number_present'),
            Column::make('Occurrence', 'occurrence_participant','occurrence')
                ->sortable()
                ->searchable(),

            Column::make('Plant id', 'plant_id')->hidden(),
           Column::make('Regeneration', 'regeneration_participant','regeneration')
                ->sortable()
                ->searchable(),

            Column::make('Survey id', 'survey_id')->hidden(),

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
