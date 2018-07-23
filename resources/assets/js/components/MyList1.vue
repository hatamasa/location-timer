<template>
    <div>
        <h1>My List1</h1>
        <select v-model="selected">
            <option v-for="country in countries" v-bind:value="country.id">
                {{ country.country_name }}
            </option>
        </select>
        <button type="button" v-on:click="addCountry()">MyListに追加</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">country_name</th>
                    <th scope="col">timezone</th>
                    <th scope="col">time</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in japan">
                    <td scope="row">{{ row.id }}</td>
                    <td scope="row">{{ row.country_name }}</td>
                    <td scope="row">{{ row.timezone }}</td>
                    <td>{{ row.utc_diff | calculateTime }}</td>
                    <td></td>
                </tr>
                <tr v-for="row in myList1">
                    <td scope="row">{{ row.id }}</td>
                    <td scope="row">{{ row.country_name }}</td>
                    <td scope="row">{{ row.timezone }}</td>
                    <td>{{ row.utc_diff | calculateTime }}</td>
                    <td><button type="button" v-on:click="deleteCountry(row.id)">削除</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    data () {
        return {
            selected: "",
            countries: [],
            japan: [],
            myList1: [],
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
            // 日本を取得
            this.$http({
                url: '/api/country/81',
                method: 'GET'
            }).then(res => {
                this.japan.push({
                    id: res.data['id'],
                    country_name: res.data['country_name'],
                    utc_diff: res.data['utc_diff'],
                    timezone: res.data['timezone'],
                });
            });
        },
        loadMyList1 () {
            this.myList1 = JSON.parse(localStorage.getItem('myList1'));
            if (! this.myList1) {
                this.myList1 = [];
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
                    timezone: res.data['timezone'],
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
        }
    },
    filters: {
        calculateTime: function (date) {
            var dt = new Date();
            var offset = dt.getTimezoneOffset() / 60;
            var hours = dt.getHours();
            // UTC標準時間に設定
            dt.setHours(hours + offset);

            var sign = date.substr(3, 1);
            var hour_diff = date.substr(4, 2);
            var minutes_diff = date.substr(7, 2);
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
        }
    }
}
</script>