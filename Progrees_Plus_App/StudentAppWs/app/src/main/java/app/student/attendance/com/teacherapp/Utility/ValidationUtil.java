package app.student.attendance.com.teacherapp.Utility;

import android.content.Context;
import android.text.TextUtils;
import android.widget.TextView;

import org.json.JSONObject;

import java.util.HashMap;
import java.util.Iterator;

import app.student.attendance.com.teacherapp.R;

/**
 * Utility class holds validation methods
 */
public class ValidationUtil {

    /**
     * Method to check valid eMail or not
     *
     * @param email emailId to check valid or not
     */
    public static boolean isValidEmail(String email) {
        return email != null && android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    /**
     * Method to check string empty or not
     */
    public static boolean isEmpty(String value) {
        return value == null || TextUtils.isEmpty(value.trim());
    }

    public static boolean isValid(JSONObject jsonObject, String key) {
        return !ValidationUtil.isEmpty(jsonObject.optString(key)) && !jsonObject.optString(key).toLowerCase().equalsIgnoreCase("false");
    }



    public static void setString(JSONObject jsonObject, String key, TextView textView, Context context) {
        try {
            if (isValid(jsonObject, key)) {
                textView.setText(jsonObject.optString(key));
            } else {
                textView.setText(context.getString(R.string.na));
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }


    public static void setString(JSONObject jsonObject, String key, TextView textView, String toSet) {
        try {
            if (isValid(jsonObject, key)) {
                textView.setText(jsonObject.optString(key));
            } else {
                textView.setText(toSet);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public static HashMap jsonToMap(JSONObject jObject) throws Exception {

        HashMap<String, String> map = new HashMap<String, String>();
        Iterator<?> keys = jObject.keys();

        while (keys.hasNext()) {
            String key = (String) keys.next();
            String value = jObject.getString(key);
            map.put(key, value);
        }
        return map;
    }

}
