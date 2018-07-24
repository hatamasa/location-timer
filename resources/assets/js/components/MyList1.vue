<template>
    <div>
        <h1>My List1</h1>
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
                        <th scope="col">country_name</th>
                        <th scope="col">time</th>
                        <th scope="col" class="time-bar-header">
                            <a href="javascript:void(0)" v-on:click="addHour -= 1">< defore</a>
                            <a href="javascript:window.location.reload();">now</a>
                            <a href="javascript:void(0)" v-on:click="addHour += 1">after ></a>
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in myList1">
                        <td scope="row">{{ row.country_name }}</td>
                        <td>{{ row.utc_diff | getTimeFromDiff(1) }}</td>
                        <td scope="row" class="time-bar">
                            <div class="bar-inline">
                                <div v-for="n in 24" class="timeCol" v-bind:class="row.utc_diff | getTimeFromDiff | calcTime(n, addHour) | getTimeClass">
                                    {{ row.utc_diff | getTimeFromDiff | calcTime(n, addHour) }}
                                </div>
                            </div>
                        </td>
                        <td><button type="button" v-on:click="deleteCountry(row.id)">削除</button></td>
                    </tr>
                </tbody>
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
    border: solid 1px #ccc;
    padding: 0px 1px 0px 1px;
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
  .mid-night {
    background-color: #ccc;
  }
</style>

<script>
import moment from 'moment';
export default {
    data () {
        return {
            selected: "",
            countries: [],
            myList1: [],
            addHour: 0,
            /* timeClass {
                isMorning: false,
                isDay: false,
                isNight: false,
            } */
        }
    },
    mounted: function() {
        this.fetchCountry();
        this.loadMyList1();
    },
    methods: {
        fetchCountry () {
            this.$http({
                url: '/api/country',
                method: 'GET'
            }).then(res =>  {
                this.countries = res.data
            });
        },
        loadMyList1 () {
            this.myList1 = JSON.parse(localStorage.getItem('myList1'));
            if (this.myList1.length == 0) {
                // 日本を取得
                this.$http({
                    url: '/api/country/81',
                    method: 'GET'
                }).then(res => {
                    this.myList1.push({
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
                this.myList1.push({
                    id: res.data['id'],
                    country_name: res.data['country_name'],
                    utc_diff: res.data['utc_diff'],
                });
                this.saveMyList1();
            })
        },
        saveMyList1 () {
            localStorage.setItem('myList1', JSON.stringify(this.myList1));
        },
        deleteCountry (id) {
            this.myList1.some((val, idx) => {
                if (val.id == id) {
                    this.myList1.splice(idx, 1);
                }
            });
            this.saveMyList1();
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
                return month+'/'+day+' '+hour+':'+minutes;
            } else {
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
            if (minutes != '00') {
                return month+'/'+day+' '+hour+':'+minutes;
            } else {
                return month+'/'+day+' '+hour;
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
                case (hour >= 0 && hour <= 5):
                    return "mid-night";
            }
        },
    },
}
</script>