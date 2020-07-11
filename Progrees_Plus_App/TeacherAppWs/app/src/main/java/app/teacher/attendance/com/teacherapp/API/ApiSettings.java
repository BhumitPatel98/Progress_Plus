package app.teacher.attendance.com.teacherapp.API;

import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.widget.Toast;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

import app.teacher.attendance.com.teacherapp.Utility.OnDataSendToActivity;
import app.teacher.attendance.com.teacherapp.Utility.ProgressDialogUtil;

/**
 * Created by jogendra on 3/11/2016.
 * Class To design URLs used for API calling
 */
public class ApiSettings {
    //LIVE Server URL
    private static String BASE_URL = "http://www.opustech.in/progress_api/"; // ip base url
    public static final String LOGIN_URL = BASE_URL + "staff_login.php";
    public static final String DASHBOARD = BASE_URL + "staff_dashboard.php";
    public static final String TIMETABLE = BASE_URL + "staff_timetable.php";
    public static final String STUDENT_LIST = BASE_URL + "Student_List.php";
    public static final String SUBMIT_ATTENDANCE = BASE_URL + "Student_Submit.php";
    public static final String FILE_UPLOAD = BASE_URL + "Upload_File.php";
    public static final String ADD_NOTICEBOARD = BASE_URL + "Add_Noticeboard.php";
    public static final String GET_CLASSNAME = BASE_URL + "Get_ClassName.php";
    public static final String STAFF_NOTICELIST = BASE_URL + "Staff_Noticelist.php";
    public static final String NOTICELIST_DELETE = BASE_URL + "Delete_Noticelist.php";
    public static final String CHANGE_PASS = BASE_URL + "Staff_Change_Password.php";
    public static final String STUDENT_GET_PROFILE = BASE_URL + "View_Staff_Profile.php";
    public static final String STUDENT_EDIT_PROFILE = BASE_URL + "Staff_Profile.php";
    public static final String PPIC_UPLOAD = BASE_URL + "Upload_Staff_Pic.php";


    public static void UploadFile(AppCompatActivity activity, OnDataSendToActivity onresult, String action, String Institute_ID, String Staff_ID, File file) {
        try {
            new UploadFileBg(activity, onresult, action, Institute_ID, Staff_ID, file).execute();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    int serverResponseCode;

    public static class UploadFileBg extends AsyncTask<String, String, String> {
        AppCompatActivity activity;
        OnDataSendToActivity onresult;
        String responseString = null;
        File file;
        String Institute_ID, Staff_ID, action;

        public UploadFileBg(AppCompatActivity activity, OnDataSendToActivity onresult, String action, String Institute_ID, String Staff_ID, File file) {
            this.activity = activity;
            this.onresult = onresult;
            this.file = file;
            this.Institute_ID = Institute_ID;
            this.action = action;
            this.file = file;
            this.Staff_ID = Staff_ID;
        }


        @Override
        protected String doInBackground(String... strings) {
            return uploadFile(action, Institute_ID + "", Staff_ID, file);
        }

        public String uploadFile(String action, String Institute_ID, String Staff_ID, File sourceFile) {


            String fileName = sourceFile.getName();

            HttpURLConnection conn = null;
            DataOutputStream dos = null;
            String lineEnd = "\r\n";
            String twoHyphens = "--";
            String boundary = "*****";
            int bytesRead, bytesAvailable, bufferSize;
            byte[] buffer;
            int maxBufferSize = 1 * 1024 * 1024;
            String result = "";

            try {

                // open a URL connection to the Servlet
                FileInputStream fileInputStream = new FileInputStream(sourceFile);
                URL url = new URL(ApiSettings.FILE_UPLOAD);

                // Open a HTTP  connection to  the URL
                conn = (HttpURLConnection) url.openConnection();
                conn.setDoInput(true); // Allow Inputs
                conn.setDoOutput(true); // Allow Outputs
                conn.setUseCaches(false); // Don't use a Cached Copy
                conn.setRequestMethod("POST");
                conn.setRequestProperty("Connection", "Keep-Alive");
                conn.setRequestProperty("ENCTYPE", "multipart/form-data");
                conn.setRequestProperty("Content-Type", "multipart/form-data;boundary=" + boundary);
                conn.setRequestProperty("uploaded_file", fileName);

                dos = new DataOutputStream(conn.getOutputStream());

                dos.writeBytes(twoHyphens + boundary + lineEnd);
                dos.writeBytes("Content-Disposition: form-data; name=" + "File" + ";filename=\""
                        + fileName + "\"" + lineEnd);

                dos.writeBytes(lineEnd);

                // create a buffer of  maximum size
                bytesAvailable = fileInputStream.available();

                bufferSize = Math.min(bytesAvailable, maxBufferSize);
                buffer = new byte[bufferSize];

                // read file and write it into form...
                bytesRead = fileInputStream.read(buffer, 0, bufferSize);

                while (bytesRead > 0) {

                    dos.write(buffer, 0, bufferSize);
                    bytesAvailable = fileInputStream.available();
                    bufferSize = Math.min(bytesAvailable, maxBufferSize);
                    bytesRead = fileInputStream.read(buffer, 0, bufferSize);

                }

                // send multipart form data necesssary after file data...
                dos.writeBytes(lineEnd);
                dos.writeBytes(twoHyphens + boundary + twoHyphens + lineEnd);


                StringBuffer sb = new StringBuffer();
                InputStream is = null;

                try {
                    is = new BufferedInputStream(conn.getInputStream());
                    BufferedReader br = new BufferedReader(new InputStreamReader(is));
                    String inputLine = "";
                    while ((inputLine = br.readLine()) != null) {
                        sb.append(inputLine);
                    }
                    result = sb.toString();
                } catch (Exception e) {
                    Log.i("TAG", "Error reading InputStream");
                    result = null;
                } finally {
                    if (is != null) {
                        try {
                            is.close();
                        } catch (IOException e) {
                            Log.i("TAG", "Error closing InputStream");
                        }
                    }
                }

                //close the streams //
                fileInputStream.close();
                dos.flush();
                dos.close();

            } catch (MalformedURLException ex) {
                ex.printStackTrace();

                activity.runOnUiThread(new Runnable() {
                    public void run() {
                        Toast.makeText(activity, "MalformedURLException",
                                Toast.LENGTH_SHORT).show();
                    }
                });

                Log.e("Upload file to server", "error: " + ex.getMessage(), ex);
            } catch (Exception e) {
                e.printStackTrace();

                activity.runOnUiThread(new Runnable() {
                    public void run() {
                        Toast.makeText(activity, "Got Exception : see logcat ",
                                Toast.LENGTH_SHORT).show();
                    }
                });
                Log.e("TAG", "Exception : "
                        + e.getMessage(), e);
            }
            return result + "";
        }

//        private String uploadFile(String action, String Institute_ID, String Staff_ID, File file) {
//            try {
//                String charset = "UTF-8";
//                try {
//                    String filenameArray[] = file.getName().split("\\.");
//
//                    String extension = filenameArray[filenameArray.length - 1];
//                    final InputStream stream = new FileInputStream(file);
//                    final byte[] bytes = new byte[stream.available()];
//                    stream.read(bytes);
//                    stream.close();
////                    HttpResponse<JsonNode> response = null;
////                    try {
////                        response = Unirest.post(ApiSettings.FILE_UPLOAD)
////                                .header("content-type", "multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW")
////                                .header("cache-control", "no-cache")
////                                .header("accept", "application/json")
////                                .header("Content-Type", "application/json")
////                                .field("Institute_ID", Institute_ID)
////                                .field("Staff_ID", Staff_ID)
////                                .field("File", file)
////                                .asJson();
////                    } catch (UnirestException e) {
////                        e.printStackTrace();
////                    }
//
////                    HttpResponse<String> response = Unirest.post(ApiSettings.FILE_UPLOAD)
////                            .header("content-type", "multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW")
////                            .header("cache-control", "no-cache")
////                            .header("postman-token", "22d192fc-39d9-b4f9-22a6-898df9090115")
////                            .body("------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"Institute_ID\"\r\n\r\n" + Institute_ID + "\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; " +
////                                    "name=\"Staff_ID\"\r\n\r\n" + Staff_ID + "\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; " +
////                                    "name=\"File\"; filename=\"" + file.getPath() + "\"\r\nContent-Type: " +
////                                    "application/" + extension + "\r\n\r\n\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--")
////                            .asString();
//
//                    HttpResponse<String> response = Unirest.post("http://www.opustech.in/SchoolStaff/Upload_File.php")
//                            .header("content-type", "multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW")
//                            .header("cache-control", "no-cache")
//                            .header("postman-token", "694a618d-3de1-30f4-6c42-5ff8c3cdcc3c")
//                            .body("------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: " +
//                                    "form-data; name=\"Institute_ID\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\n" +
//                                    "Content-Disposition: form-data; " +
//                                    "name=\"Staff_ID\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: " +
//                                    "form-data; name=\"File\"; filename=\"27411.png\"\r\nContent-Type: image/png\r\n\r\n\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--")
//                            .asString();
//                    //AlertDialogManager.showDialog(activity, response.getBody(), "Ok", null, null);
//
////                    MultipartUtility multipart = new MultipartUtility(ApiSettings.FILE_UPLOAD, charset);
////                    if (file != null)
////                        multipart.addFilePart("File", file);
//////                    multipart.addFormField("action", action);
////                    multipart.addFormField("Institute_ID", Institute_ID);
////                    multipart.addFormField("Staff_ID", Staff_ID);
////                    Log.d("TAGT", action);
////                    List<String> response = multipart.finish();
//
//                    System.out.println("SERVER REPLIED:" + response.getBody());
//                    responseString = response.getBody();
////                    for (String line : response) {
////                        System.out.println(line);
////                        responseString = line;
////                    }
//                } catch (Exception ex) {
//                    System.err.println(ex);
//                    responseString = ex.getMessage();
//                    Toast.makeText(activity, "File does not exists", Toast.LENGTH_SHORT);
//                }
//
//            } catch (Exception e) {
//                e.printStackTrace();
//                Log.e("TAGT", "Exception: " + e.getMessage());
//                responseString = e.getMessage();
//            }
//            return responseString;
//        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            try {
                if (activity != null) {
                    activity.runOnUiThread(new Runnable() {

                        @Override
                        public void run() {
                            ProgressDialogUtil.showDialog(activity);
                        }
                    });
                }
            } catch (Exception e) {
                e.printStackTrace();
                Log.e("TAGT", "Exception: " + e.getMessage());
            }

        }

        @Override
        protected void onPostExecute(String result) {
            super.onPostExecute(result);
            try {
                if (activity != null) {
                    activity.runOnUiThread(new Runnable() {

                        @Override
                        public void run() {
                            ProgressDialogUtil.hideDialog();
                        }
                    });
                }
                if (onresult != null && result != null) {
                    Log.v("TAGT", "l RESPONSE:" + result);
                    onresult.sendData(result, "flag");
                } else
                    Log.v("TAGT", "RESPONSE:" + result);
            } catch (Exception e) {
                e.printStackTrace();
                Log.e("TAGT", "Exception: " + e.getMessage());
            }
        }

    }
}
