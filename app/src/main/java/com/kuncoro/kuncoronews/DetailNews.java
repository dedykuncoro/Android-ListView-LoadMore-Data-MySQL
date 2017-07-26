package com.kuncoro.kuncoronews;

import android.os.Bundle;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.text.Html;
import android.util.Log;
import android.view.MenuItem;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.ImageLoader;
import com.android.volley.toolbox.NetworkImageView;
import com.android.volley.toolbox.StringRequest;
import com.kuncoro.kuncoronews.app.AppController;
import com.kuncoro.kuncoronews.util.Server;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by Kuncoro on 29/02/2016.
 */
public class DetailNews extends AppCompatActivity implements SwipeRefreshLayout.OnRefreshListener {

    NetworkImageView thumb_image;
    TextView judul, tgl, isi;
    ImageLoader imageLoader = AppController.getInstance().getImageLoader();
    SwipeRefreshLayout swipe;
    String id_news;

    private static final String TAG = DetailNews.class.getSimpleName();

    public static final String TAG_ID = "id";
    public static final String TAG_JUDUL = "judul";
    public static final String TAG_TGL = "tgl";
    public static final String TAG_ISI = "isi";
    public static final String TAG_GAMBAR = "gambar";

    private static final String url_detail = Server.URL + "detail_news.php";
    String tag_json_obj = "json_obj_req";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.detail_news);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        setTitle("Detail News");

        thumb_image = (NetworkImageView) findViewById(R.id.gambar_news);
        judul = (TextView) findViewById(R.id.judul_news);
        tgl = (TextView) findViewById(R.id.tgl_news);
        isi = (TextView) findViewById(R.id.isi_news);
        swipe = (SwipeRefreshLayout) findViewById(R.id.swipe_refresh_layout);

        id_news = getIntent().getStringExtra(TAG_ID);

        swipe.setOnRefreshListener(this);

        swipe.post(new Runnable() {
                       @Override
                       public void run() {
                           if (!id_news.isEmpty()) {
                               callDetailNews(id_news);
                           }
                       }
                   }
        );

    }

    private void callDetailNews(final String id) {
        swipe.setRefreshing(true);

        StringRequest strReq = new StringRequest(Request.Method.POST, url_detail, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                Log.e(TAG, "Response " + response.toString());
                swipe.setRefreshing(false);

                try {
                    JSONObject obj = new JSONObject(response);

                    String Judul = obj.getString(TAG_JUDUL);
                    String Gambar = obj.getString(TAG_GAMBAR);
                    String Tgl = obj.getString(TAG_TGL);
                    String Isi = obj.getString(TAG_ISI);

                    judul.setText(Judul);
                    tgl.setText(Tgl);
                    isi.setText(Html.fromHtml(Isi));

                    if (obj.getString(TAG_GAMBAR) != "") {
                        thumb_image.setImageUrl(Gambar, imageLoader);
                    }

                } catch (JSONException e) {
                    e.printStackTrace();
                }

            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e(TAG, "Detail News Error: " + error.getMessage());
                Toast.makeText(DetailNews.this,
                        error.getMessage(), Toast.LENGTH_LONG).show();
                swipe.setRefreshing(false);
            }
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting parameters to post url
                Map<String, String> params = new HashMap<String, String>();
                params.put("id", id);

                return params;
            }

        };

        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(strReq, tag_json_obj);
    }

    @Override
    public void onBackPressed() {
        finish();
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                this.finish();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    @Override
    public void onRefresh() {
        callDetailNews(id_news);
    }
}