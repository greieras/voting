<template>
    <div class="container">
        <div v-if="voted === true">
            <h3 class="text-center"><span class="fa fa-line-chart"></span> How do you find our service?</h3>
            <p>Results are: </p>
            <ul class="list-group">
                <li class="list-group-item" v-for="picked in sortArrays(votes)" :key="picked.id" >{{picked.name}} {{picked.value}} %</li>
            </ul>
        </div>
        <div class="panel panel-primary" v-else>
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-line-chart"></span> How do you find our service?</h3>
            </div>
            <form @submit.prevent="send">
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item" v-for="option in options" :key="option.id">
                        <div class="radio">
                            <label>
                                <input type="radio" v-bind:value="option.id" v-model="picked"> {{ option.name }}
                            </label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="panel-footer text-center">
                <span class="text-danger">{{errors}}</span>
                <button type="submit" class="btn btn-primary btn-block btn-sm">Send</button>
            </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "Vote",
    data() {
        return {
            options: [],
            option: '',
            picked: '',
            errors: '',
            votes: [],
            voted: ''
        }
    },
    created() {
        this.fetchOptions();
        this.fetchVotes();
        this.fetchVoted();
    },
    methods: {
        send() {
            if(this.picked == ''){
                this.errors = 'You must choose';
                return;
            }

            axios.post('/api/vote', {
                picked: this.picked
            })
                .then((res) => {
                    if (res.data.success) {
                        this.voted = true;
                        this.fetchVotes();
                    }
                });
        },
        sortArrays(arrays) {
            return _.orderBy(arrays, 'value', 'desc');
        },
        fetchVoted() {
            axios.get(`/api/voted`)
                .then((res) => {
                    if(res.data.voted == 1){
                        this.voted = true
                    }
                });
        },
        fetchOptions() {
            axios.get(`/api/options`)
                .then(res => this.options = res.data.options);
        },
        fetchVotes() {

            axios.get(`/api/votes`)
                .then(
                    res => this.votes = res.data.votes);
        },
    }
}
</script>

<style scoped>
.panel-body:not(.two-col) {
    padding: 0px;
}

.glyphicon {
    margin-right: 5px;
}

.glyphicon-new-window {
    margin-left: 5px;
}

.panel-body .radio, .panel-body .radio {
    margin-top: 0px;
    margin-bottom: 0px;
}

.panel-body .list-group {
    margin-bottom: 0;
}

.margin-bottom-none {
    margin-bottom: 0;
}

.panel-body .radio label, .panel-body .radio label {
    display: block;
}
</style>
