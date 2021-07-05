<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card elevation-2">
                    <div class="card-body  pa-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <v-text-field
                                    label="Éves keret"
                                    hide-details="auto"
                                    type="number"
                                    v-model="yearly"
                                ></v-text-field>

                            </div>
                            <div class="col-sm-6">
                                <v-col>
                                    <strong>Maradék összeg: {{ rest }}</strong>
                                </v-col>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card elevation-2 pa-4">
                    <div class="card-header">Hónapok, elosztás</div>

                    <div class="card-body" v-if="renderCafData">
                        <div class="row" v-for="i in 12" :key="i">

                            <div class="col-md-3">
                                <v-col>
                                    {{ months[i - 1] }}
                                </v-col>
                            </div>
                            <div class="col-md-3">
                                <v-text-field
                                    class="mx-3"
                                    :label="slots['a']"
                                    hide-details="auto"
                                    type="number"
                                    v-model="cafData['a'][i]"
                                ></v-text-field>
                            </div>
                            <div class="col-md-3">
                                <v-text-field
                                    class="mx-3"
                                    :label="slots['b']"
                                    type="number"
                                    hide-details="auto"

                                    v-model="cafData['b'][i]"

                                >
                                </v-text-field>

                            </div>
                            <div class="col-md-3">
                                <v-text-field
                                    class="mx-3"
                                    type="number"
                                    :label="slots['c']"
                                    hide-details="auto"
                                    v-model="cafData['c'][i]"
                                ></v-text-field>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card elevation-2 pa-4">
                    <div class="card-footer">

                        <v-btn color="" @click="autoFill()">Automatikus kitöltés</v-btn>
                        <v-btn @click="fullLimit" color="secondary">Ellenőrzés</v-btn>
                        <v-btn @click="save()" :disabled="!saveEnabled" color="primary">Mentés</v-btn>

                    </div>
                </div>


            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            errors: '',
            saveEnabled: false,
            slotLimit: 200000,
            slots: {
                'a': 'Szállás',
                'b': 'Vendéglátás',
                'c': 'Szabadidő',
            },

            renderCafData: true,
            yearly: 400000,
            cafData: {
                'a': [],
                'b': [],
                'c': [],
            }

        }
    },
    computed: {
        months() {
            return moment.months()
        },
        rest() {
            this.renderCafData = false;
            let sum = 0;
            Object.keys(this.slots).forEach(key => {
                sum += this.slotSum(key)
            })
            this.renderCafData = true;
            return parseInt(this.yearly - sum);

        }
    },
    methods: {

        slotSum(slot) {
            let sum = 0;
            this.cafData[slot].forEach(val => {
                if (val) {
                    sum += parseInt(val);
                }
            })
            return sum;
        },

        slotLimitCheck(slot) {
            return parseInt(this.slotSum(slot)) >= parseInt(this.slotLimit);
        },

        fullLimit() {
            this.errors = '';
            let valid = true;
            Object.keys(this.slots).forEach(key => {
                if (this.slotLimitCheck(key)) {
                    this.errors += (this.slots[key] + " zseb összege nagyobb mint " + this.slotLimit + '!\r\n')
                    this.saveEnabled = false;
                }
            })
            if (this.errors) {
                alert(this.errors);
                this.saveEnabled = false;
                return false;
            }
            this.saveEnabled = true;
            return true;
        },

        autoFill() {

            this.renderCafData = false;
            let am = Math.round(this.yearly / (3 * 12));
            for (let i = 1; i < 13; i++) {
                this.cafData['a'][i] = am;
                this.cafData['b'][i] = am;
                this.cafData['c'][i] = am;
            }
            this.renderCafData = true;
        },


        loadLast() {
            axios.get('/api/cafeteria').then(response => {
                console.log(response.data);
                this.cafData = response.data.data;
                this.yearly = response.data.yearly_limit;

            })


        },

        save() {
            if (this.fullLimit()) {
                axios.post('/api/cafeteria', {
                    cafData: this.cafData,
                    slotLimit: this.slotLimit,
                    fullLimit: this.yearly
                }).then(response => {
                    console.log(response.data);
                }).catch(err => {
                    console.log(err);
                })
            }

        }
    },
    created() {
        this.loadLast();
    }


}
</script>
