<template>
    <div>
        <h1>Location MyList</h1>
        <select v-model="selected">
            <option v-for="country in countries" v-bind:value="country.id">
                {{ country.country_name }}
            </option>
        </select>
        <button type="button" v-on:click="addCountry()">MyListに追加</button>
        <div class="table-area">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="country_name">country_name</th>
                        <th scope="col" class="time">time</th>
                        <th scope="col" class="time-bar-header">
                            <div v-for="n in 24" class="forcus" @mouseover="forcusTime" @mouseleave="forcusOutTime"></div>
                            <el-date-picker v-model="date" type="date" placeholder="change date..." @change="changeDate()"></el-date-picker>
                            <a href="javascript:void(0)" @click="addHour -= 1">< defore</a>
                            <a href="javascript:window.location.reload();">now</a>
                            <a href="javascript:void(0)" @click="addHour += 1">after ></a>
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <draggable :element="'tbody'" v-model="myList"
                    v-bind:options="{ animation: 200, delay: 50, handle:'.handle' }" @end="onEnd">
                    <tr v-for="row in myList">
                        <td scope="row" class="handle">{{ row.country_name }}</td>
                        <td>{{ row.utc_diff | getTimeFromDiff(1) }}</td>
                        <td scope="row" class="time-bar">
                            <div class="bar-inline">
                                <div v-for="n in 24" class="timeCol" v-bind:class="row.utc_diff | getTimeFromDiff | calcTime(n, addHour) | getTimeClass">
                                    {{ row.utc_diff | getTimeFromDiff | calcTime(n, addHour) }}
                                </div>
                            </div>
                        </td>
                        <td><button type="button" @click="deleteCountry(row.id)" class="deleteCountry">削除</button></td>
                    </tr>
                </draggable>
            </table>
        </div>
    </div>
</template>

<style>
  .table-area {
    width: 100%;
    overflow-x: scroll;
    border: solid 1px #ccc;
  }
  .table-area table {
    font-size: 11px;
    margin-bottom: 0;
  }
  .country_name {
    min-width: 200px;
    max-width: 200px;
    width: 200px;
  }
  .time {
    min-width: 46px;
    width: 46px;
  }
  .time-bar-header {
    text-align: center;
  }
  .time-bar-header a {
    margin: 20px;
  }
  .time-bar {
    display: table-cell;
    text-align: center;
  }
  .time-bar div.bar-inline {
    display: flex;
  }
  .bar-inline div {
    width: 33px;
    border: solid 1px #ccc;
    padding: 0px 1px 0px 1px;
    border-radius: 5px;
  }
  .morning {
    background-color: #fcf8e3;
  }
  .day {
    background-color: #f2dede
  }
  .night {
    background-color: #eee;
  }
  .twelve-mid-night {
    border-left: solid 3px #409eff !important;
  }
  .mid-night {
    background-color: #ccc;
  }
  .handle {
    cursor: pointer;
  }
  .handle:hover {
    border: solid 2px #bbb;
  }
  .forcus {
    position: absolute;
    width: 33.5px;
  }
</style>

<script>
import moment from 'moment';
export default {
    data () {
        return {
            selected: "",
            countries: [],
            myList: [],
            date: "",
            addHour: 0,
        }
    },
    mounted: function () {
        this.initData();
        this.fetchCountry();
        this.loadMyList();
    },
    updated: function () {
        this.changeForcusHeight();
        this.changeForcusOffset();
    },
    methods: {
        initData () {
            this.date = new Date();
        },
        fetchCountry () {
            let axiosPost = axios.create({
                xsrfHeaderName: 'X-XSRF-Token',
                withCredentials: true
            });
            axiosPost.post('/api/country',{

            })
            .then(res =>  {
                this.countries = res.data
            });
        },
        loadMyList () {
            this.myList = JSON.parse(localStorage.getItem('myList'));
            if (! this.myList) {
                this.myList = [];
                // 日本を取得
                this.$http({
                    url: '/api/country/81',
                    method: 'GET'
                }).then(res => {
                    this.myList.push({
                        id: res.data['id'],
                        country_name: res.data['country_name'],
                        utc_diff: res.data['utc_diff'],
                    });
                });
            }
        },
        addCountry () {
            if (! this.selected) return;
            this.$http({
                url: '/api/country/'+this.selected,
                method: 'GET'
            }).then(res => {
                this.myList.push({
                    id: res.data['id'],
                    country_name: res.data['country_name'],
                    utc_diff: res.data['utc_diff'],
                });
                this.saveMyList();
            })
            this.changeForcusHeight();
        },
        changeDate () {
            var date1 = new Date();
            var date2 = new Date(this.date);
            var ms_diff = date2.getTime() - date1.getTime();
            var days_diff = Math.floor(ms_diff / (1000 * 60 * 60 *24));
            this.addHour = (days_diff + 1) * 24;
        },
        saveMyList () {
            localStorage.setItem('myList', JSON.stringify(this.myList));
        },
        deleteCountry (id) {
            this.myList.some((val, idx) => {
                if (val.id == id) {
                    this.myList.splice(idx, 1);
                }
            });
            this.saveMyList();
            // フォーカスの高さを変更
            this.changeForcusHeight();
        },
        getTimeFromDiff (diff) {
            var dt = new Date();
            var offset = dt.getTimezoneOffset() / 60;
            var hours = dt.getHours();
            // UTC標準時間に設定
            dt.setHours(hours + offset);

            var sign = diff.substr(3, 1);
            var hour_diff = diff.substr(4, 2);
            var minutes_diff = diff.substr(7, 2);
            if (sign == "+") {
                var now = dt.getTime() + ((parseInt(hour_diff)*60 + parseInt(minutes_diff)) * 60000);
            } else if (sign == "-") {
                var now = dt.getTime() - ((parseInt(hour_diff)*60 + parseInt(minutes_diff)) * 60000);
            }
            var jikan = new Date(now);
            var month = ('00' + (jikan.getMonth()+1)).slice(-2);
            var day = ('00' + jikan.getDate()).slice(-2);
            var hour = ('00' + jikan.getHours()).slice(-2);
            var minutes = ('00' + jikan.getMinutes()).slice(-2);
            return month+'/'+day+' '+hour+':'+minutes;
        },
        onEnd () {
            this.saveMyList();
        },
        forcusTime (event) {
            event.target.style.border = "solid 2px #409eff";
        },
        forcusOutTime (event) {
            event.target.style.border = "none";
        },
        changeForcusHeight () {
            var header_height = $(".time-bar-header").outerHeight();
            var table_height = $(".table").innerHeight();
            $(".forcus").css("height", table_height - header_height);
        },
        changeForcusOffset () {
            var header_height = $(".time-bar-header").outerHeight();
            var col_width = $(".timeCol").outerWidth();
            if (! $(".time-bar").length) return;
            var time_bar_padding_left = parseInt($(".time-bar").css("padding-left").replace("px", ""));
            var offset = $(".time-bar-header").offset();
            $(".forcus").each((idx, elem) => {
                elem.style.top = offset["top"] + header_height + "px";
                elem.style.left = offset["left"] + time_bar_padding_left + (parseInt(idx) * col_width) + "px";
            });
        }
    },
    filters: {
        getTimeFromDiff (diff, min_flg) {
            var dt = new Date();
            var offset = dt.getTimezoneOffset() / 60;
            var hours = dt.getHours();
            // UTC標準時間に設定
            dt.setHours(hours + offset);

            var sign = diff.substr(3, 1);
            var hour_diff = diff.substr(4, 2);
            var minutes_diff = diff.substr(7, 2);
            if (sign == "+") {
                var now = dt.getTime() + ((parseInt(hour_diff)*60 + parseInt(minutes_diff)) * 60000);
            } else if (sign == "-") {
                var now = dt.getTime() - ((parseInt(hour_diff)*60 + parseInt(minutes_diff)) * 60000);
            }
            var jikan = new Date(now);
            var month = ('00' + (jikan.getMonth()+1)).slice(-2);
            var day = ('00' + jikan.getDate()).slice(-2);
            var hour = ('00' + jikan.getHours()).slice(-2);
            var minutes = ('00' + jikan.getMinutes()).slice(-2);
            if (min_flg) {
                // min_flgがある時は現在時刻を返却する
                return month+'/'+day+' '+hour+':'+minutes;
            } else {
                // min_flgがない時はUTC時差から分を連結する
                return month+'/'+day+' '+hour+':'+minutes_diff;
            }
        },
        calcTime (time, n, addHour) {
            var dt = new Date();
            var newDate = new Date(dt.getFullYear(), time.substr(0, 2), time.substr(3, 2), time.substr(6, 2), time.substr(9, 2));
            newDate.setHours(newDate.getHours()+(n-1+addHour));
            var month = ('00' + newDate.getMonth()).slice(-2);
            var day = ('00' + newDate.getDate()).slice(-2);
            var hour = ('00' + newDate.getHours()).slice(-2);
            var minutes = ('00' + newDate.getMinutes()).slice(-2);
            if (minutes == '00') {
                // 分が00の場合は分表示なし
                return month+'/'+day+' '+hour;
            } else {
                // 分が00以外の場合は分を表示
                return month+'/'+day+' '+hour+':'+minutes;
            }
        },
        getTimeClass (time) {
            var hour = parseInt(time.substr(6, 2));
            switch (true) {
                case (hour >= 6 && hour <= 8):
                    return "morning";
                case (hour >= 9 && hour <= 18):
                    return "day";
                case (hour >= 19 && hour <= 24):
                    return "night";
                case hour == 0:
                    return "mid-night twelve-mid-night";
                case (hour >= 1 && hour <= 5):
                    return "mid-night";
            }
        },
    },
}
</script>