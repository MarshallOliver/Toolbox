<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ButtonUpdateController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function index()
    {

        $locations = \App\Location::with('databases')->get();

    	return view('tools.button_updates', ['locations' => $locations]);
    }

    public function execute(Request $request)
    {

        $result = DB::connection($request->database)->transaction(function () use ($request) {

            DB::connection($request->database)->statement('SELECT ps.StationNo, ps.DivNo, ps.ScreenName, ps.ScreenEnable INTO ##tempState FROM PosScreens ps');
            DB::connection($request->database)->statement('SELECT DISTINCT ps.StationNo, divs.DivNo, ps.ScreenID, ps.ScreenName, ps.ModuleID INTO ##tempScreens FROM PosScreens ps, Divisions divs WHERE ps.StationNo = 0 AND ps.DivNo = 0');
            DB::connection($request->database)->statement('SELECT DISTINCT ##TempScreens.StationNo, ##TempScreens.DivNo, ##TempScreens.ScreenID, ##TempScreens.ScreenName, CASE WHEN ##TempState.ScreenEnable IS NULL THEN 1 ELSE ##TempState.ScreenEnable END AS ScreenEnable, ##TempScreens.ModuleID INTO ##tempScreensWithState FROM ##TempScreens LEFT JOIN ##TempState ON ##TempScreens.StationNo = ##TempState.StationNo AND ##TempScreens.DivNo = ##TempState.DivNo AND ##TempScreens.ScreenName = ##TempState.ScreenName');
            DB::connection($request->database)->statement('SELECT DISTINCT ps.StationNo, ps.DivNo, pk.ScreenID, pk.KeyID, pk.DayOfWeek, pk.TimeOfDay, pk.ButtonCaption, pk.CaptionColor, pk.CaptionFontName, pk.CaptionFontSize, pk.CaptionFontStyle, pk.CaptionAlign, pk.ButtonColor, pk.ButtonDesc, pk.Enabled, pk.HeadCount, pk.GroupingNo, CAST(pk.ButtonImage AS VARBINARY(MAX)) AS ButtonImage, pk.ImageAlign, pk.InvNo, pk.AutoApply, pk.DiscountID, pk.MembershipID INTO ##tempKeys FROM PosScreens ps, PosKeys pk WHERE pk.StationNo = 0 AND pk.DivNo = 0');
            DB::connection($request->database)->statement('SELECT DISTINCT ps.StationNo, ps.DivNo, pm.ScreenID, pm.ModuleID INTO ##tempModules FROM PosScreens ps, PosScreenModules pm WHERE pm.StationNo = 0 AND pm.DivNo = 0');
            DB::connection($request->database)->statement('DELETE FROM PosScreenModules');
            DB::connection($request->database)->statement('DELETE FROM PosKeys');
            DB::connection($request->database)->statement('DELETE FROM PosScreens');
            DB::connection($request->database)->statement('INSERT INTO PosScreens (PosScreens.StationNo, PosScreens.DivNo, PosScreens.ScreenID, PosScreens.ScreenName, PosScreens.ScreenEnable, PosScreens.ModuleID) SELECT ##tempScreensWithState.StationNo, ##tempScreensWithState.DivNo, ##tempScreensWithState.ScreenID, ##tempScreensWithState.ScreenName, ##tempScreensWithState.ScreenEnable, ##tempScreensWithState.ModuleID FROM ##tempScreensWithState');
            DB::connection($request->database)->statement('INSERT INTO PosKeys (StationNo, DivNo, ScreenID, KeyID, DayOfWeek, TimeOfDay, ButtonCaption, CaptionColor, CaptionFontName, CaptionFontSize, CaptionFontStyle, CaptionAlign, ButtonColor, ButtonDesc, Enabled, HeadCount, GroupingNo, ButtonImage, ImageAlign, InvNo, AutoApply, DiscountID, MembershipID) SELECT tk.StationNo, tk.DivNo, tk.ScreenID, tk.KeyID, tk.DayOfWeek, tk.TimeOfDay, tk.ButtonCaption, tk.CaptionColor, tk.CaptionFontName, tk.CaptionFontSize, tk.CaptionFontStyle, tk.CaptionAlign, tk.ButtonColor, tk.ButtonDesc, tk.Enabled, tk.HeadCount, tk.GroupingNo, tk.ButtonImage, tk.ImageAlign, tk.InvNo, tk.AutoApply, tk.DiscountID, tk.MembershipID FROM ##tempKeys tk');
            DB::connection($request->database)->statement('INSERT INTO PosScreenModules (StationNo, DivNo, ScreenID, ModuleID) SELECT tm.StationNo, tm.DivNo, tm.ScreenID, tm.ModuleID FROM ##tempModules tm');
            DB::connection($request->database)->statement('DROP TABLE ##tempModules');
            DB::connection($request->database)->statement('DROP TABLE ##tempKeys');
            DB::connection($request->database)->statement('DROP TABLE ##tempState');
            DB::connection($request->database)->statement('DROP TABLE ##tempScreens');
            DB::connection($request->database)->statement('DROP TABLE ##tempScreensWithState');
            
        });

        $database = \App\Database::findOrFail($request->database);
        $success = 'You have successfully updated the ' . $database->catalog . ' database in the ' . $database->location->long_name . ' location.';

        session()->flash('success', $success);

        return redirect('button-updates');

    }
}
