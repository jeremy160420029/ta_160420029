<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpseclib3\Net\SSH2 as NetSSH2;

class PythonController extends Controller
{
    public function showStreamingPage($id)
    {
        // return view('main.preview');

        // Raspberry Pi SSH credentials
        $host = '192.168.184.65';
        $port = 22;
        $username = 'jeremy';
        $password = 'jeremy';

        try {
            // Connect to Raspberry Pi via SSH
            $ssh = new NetSSH2($host, $port);
            if (!$ssh->login($username, $password)) {
                throw new \Exception('SSH login failed');
            }

            // Run the Python script remotely
            try{
                $output3 = $ssh->exec("curl http://localhost:5000/stop");
                $output4 = $ssh->exec("curl http://localhost:5000/start");
            } catch (\Exception $e) {
                echo "Gagal: " . $e->getMessage();
                return response()->json(['error' => $e->getMessage()], 500);
            }

            $articles = Article::find($id);

            return view('main.preview', compact("articles"));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function runRemoteScript($id)
    {
        // Raspberry Pi SSH credentials
        $host = '192.168.184.65';
        $port = 22;
        $username = 'jeremy';
        $password = 'jeremy';

        // Path to the Python script on Raspberry Pi
        // if($id=1){
        //     $remoteScriptPath = '/home/jeremy/TA-160420029/image-classification/aj1_high_univ_blue.py';
        // } else if($id=2){
        //     $remoteScriptPath = '/home/jeremy/TA-160420029/image-classification/aj1_high_univ_blue.py';
        // }

        switch ($id) {
            case 1:
                $remoteScriptPath = '/home/jeremy/TA-160420029/image-classification/aj1_high_univ_blue.py';
                break;
            case 2:
                $remoteScriptPath = '/home/jeremy/TA-160420029/image-classification/af1_triple_white.py';
                break;
            // Add more cases as needed
            default:
                return response()->json(['error' => 'Invalid id'], 400);
        }

        try {
            $user = Auth::user();
            $users_id = $user->id;

            // Connect to Raspberry Pi via SSH
            $ssh = new NetSSH2($host, $port);
            if (!$ssh->login($username, $password)) {
                throw new \Exception('SSH login failed');
            }

            // Run the Python script remotely
            $output1 = $ssh->exec("pkill -f stream.py");
            $output2 = $ssh->exec("python3 $remoteScriptPath $users_id");

            // Close the SSH connection
            $ssh->disconnect();

            $histories = History::orderBy('id', 'desc')->first();
            $articles = Article::find($histories->articles_id);

            return view('main.result', compact('histories', 'articles'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
