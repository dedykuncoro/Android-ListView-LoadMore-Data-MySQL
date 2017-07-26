package com.kuncoro.kuncoronews.adapter;

import android.app.Activity;
import android.content.Context;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.android.volley.toolbox.ImageLoader;
import com.android.volley.toolbox.NetworkImageView;
import com.kuncoro.kuncoronews.R;
import com.kuncoro.kuncoronews.app.AppController;
import com.kuncoro.kuncoronews.data.NewsData;

import java.util.List;

/**
 * Created by Kuncoro on 29/02/2016.
 */
public class NewsAdapter extends BaseAdapter {
    private Activity activity;
    private LayoutInflater inflater;
    private List<NewsData> newsItems;
    ImageLoader imageLoader;

    public NewsAdapter(Activity activity, List<NewsData> newsItems) {
        this.activity = activity;
        this.newsItems = newsItems;
    }

    @Override
    public int getCount() {
        return newsItems.size();
    }

    @Override
    public Object getItem(int location) {
        return newsItems.get(location);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        if (inflater == null)
            inflater = (LayoutInflater) activity
                    .getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if (convertView == null)
            convertView = inflater.inflate(R.layout.list_row_news, null);

        if (imageLoader == null)
            imageLoader = AppController.getInstance().getImageLoader();

        NetworkImageView thumbNail = (NetworkImageView) convertView.findViewById(R.id.news_gambar);
        TextView judul = (TextView) convertView.findViewById(R.id.news_judul);
        TextView timestamp = (TextView) convertView.findViewById(R.id.news_timestamp);
        TextView isi = (TextView) convertView.findViewById(R.id.news_isi);

        NewsData news = newsItems.get(position);

        thumbNail.setImageUrl(news.getGambar(), imageLoader);
        judul.setText(news.getJudul());
        timestamp.setText(news.getDatetime());
        isi.setText(Html.fromHtml(news.getIsi()));

        return convertView;
    }

}