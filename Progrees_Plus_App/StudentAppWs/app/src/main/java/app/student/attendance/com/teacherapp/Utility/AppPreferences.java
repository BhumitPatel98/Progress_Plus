package app.student.attendance.com.teacherapp.Utility;

import android.content.Context;
import android.content.SharedPreferences;

import app.student.attendance.com.teacherapp.R;


/**
 * Class to manage shared preference in Application
 */
public class AppPreferences {
    private static final String TAG = "AppPreferences";
    private final String USER = "USER";
    private final String CHECK_IN = "CHECK_IN";
    private final String CHECK_OUT = "CHECK_OUT";

    Context context;
    static SharedPreferences sharedPreferences;

    public AppPreferences(Context context) {
        initPreference(context);
    }

    private void initPreference(Context context) {
        this.context = context;
        sharedPreferences = context.getSharedPreferences(context.getResources().getString(R.string.app_name), Context.MODE_PRIVATE);
    }

    public void storeUser(String username) {
        sharedPreferences.edit().putString(USER, username).apply();
    }

    public String retrieveUser() {
        return sharedPreferences.getString(USER, null);
    }


    public static void clearPref() {
        sharedPreferences.edit().clear().apply();
    }
}
