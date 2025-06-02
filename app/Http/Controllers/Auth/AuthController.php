<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Penyewa;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{ /** * Write code on Method * * @return response() */
    public function index()
    {
        return view('auth.login');
    } /** * Write code on Method * * @return response() */
    public function registration()
    {
        return view('auth.registration');
    } /** * Write code on Method * * @return response() */
    public function postLogin(Request $request)
    {
        $request->validate(['email' => 'required', 'password' => 'required',]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('You have Successfully loggedin');
        }
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    } /** * Write code on Method * * @return response() */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'no_hp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/foto_penyewa', $filename);
            $data['foto'] = $filename; // Simpan hanya nama file, atau sesuaikan jika ingin path lengkap
        }

        $check = $this->create($data);
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    public function dashboard()
    {
        if (Auth::check()) {
            return view('auth.dashboard');
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    } /** * Write code on Method * * @return response() */
    public function create(array $data)
    {
        $user = User::create(['name' => $data['name'], 'email' => $data['email'], 'password' => Hash::make($data['password'])]);
        $penyewa = Penyewa::create([
            'nama' => $user->name,
            'email' => $user->email,
            'nohp' => $data['no_hp'],
            'alamat' => $data['alamat'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'foto' => $data['foto']
        ]);
        $role = Role::findByName('Penyewa');
        $user->assignRole([$role->id]);
        return $user;
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }

    public function showProfile()
    {
        $users = Auth::user();
        $penyewas = Penyewa::where('email','=',$users->email)->first();
        $properties = Booking::where('penyewa_id','=',$penyewas->id)->first();
        // dd($properties);
        return view('profile', compact('users', 'penyewas', 'properties'));
    }

}