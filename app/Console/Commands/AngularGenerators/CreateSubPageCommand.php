<?php

namespace App\Console\Commands\AngularGenerators;

class CreateSubPageCommand extends BaseGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ng:subpage {name} {pageName} {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create component files for Angular 2 Sub Page.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->validateInput();

        $pageName=$this->argument('pageName');
        $name=$this->argument('name');
         
           /**
     * Name of Subpage Component will be {pageName.name}  .. to prevent name collide.
     */ 

        $componentName = $pageName.ucfirst($name);

     
        $targetDir = $this->getTargetDir('pages'.'/'.$pageName.'/'.'subpages',$name);
        
            
        $type = 'component';

        $this->createTs($componentName, $type, $targetDir.$componentName.'.component.ts');
        $this->createHtml($componentName, $type, $targetDir.$componentName.'.component.html');
        $this->createScss($componentName, $type, $targetDir.$componentName.'.component.scss');
        $this->createSpec($componentName, $type, $targetDir.$componentName.'.spec.ts');
        $this->createIndex($componentName, $type, $targetDir.'index.ts');
         
          /**
     * Create index.ts file in subpage/index.ts
     * Append export * from './subpage' pages/index.ts 
     */ 
        $this->createSubPageExporterIndex($name,$type,$targetDir);
       
    }
}
