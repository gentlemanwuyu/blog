<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/27
 * Time: 17:17
 */

namespace App\Modules\Backend\Console;

use Illuminate\Console\Command;
use App\Modules\Backend\Models\User;

class ManageUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:manage_user {name} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset user password';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $user = User::where('name', $this->argument('name'))->first();
            if (empty($user)) {
                if (empty($this->option('email')) || empty($this->option('password'))) {
                    throw new \Exception("新建用户请传参email和password");
                }
                $user = new User;
                $user->name = $this->argument('name');
            }

            if (!empty($this->option('email'))) {
                $user->email = $this->option('email');
            }

            if (!empty($this->option('password'))) {
                $user->password = bcrypt($this->option('password'));
            }

            $user->save();
            $this->info("用户创建/修改成功");
        }catch (\Exception $e) {
            $this->error('[' . get_class($e) . ']' . $e->getMessage());
        }
    }
}