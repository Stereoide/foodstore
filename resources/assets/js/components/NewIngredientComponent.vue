<template>
    <div>
        <div class="form-group">
            <label for="name">New Product</label>
            <input type="text" class="form-control" id="name" placeholder="Product" v-model="ingredient.name" @focus="clearError('name')">
            <small class="form-text text-muted" v-show="errors.name">The product name must not be empty.</small>
        </div>

        <div class="form-group">
            <label for="name">Amount</label>
            <input type="number" class="form-control" id="amount" placeholder="Amount" v-model="ingredient.amount" @focus="clearError('amount')">
            <small class="form-text text-muted" v-show="errors.amount">The product amount must be at least 1.</small>
        </div>

        <div>
            <button class="btn btn-outline-info" @click="save">Save</button>
            <button class="btn btn-outline-dark" @click="cancel">Cancel</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: [],

        data() {
            return {
                errors: {},
                ingredient: {
                    name: '',
                    amount: 1
                },
            };
        },

        methods: {
            save() {
                /* Error checking */

                this.checkField('name');
                this.checkField('amount');

                if (Object.keys(this.errors).length === 0) {
                    this.$emit('saved', this.ingredient);
                }
            },

            cancel() {
                this.reset();
                this.$emit('cancelled');
            },

            reset() {
                this.ingredient.name = '';
                this.ingredient.amount = 1;
            },

            checkField(field) {
                let value = this.ingredient[field];

                switch (field) {
                    case 'name' :
                        if (value === '') {
                            this.errors.name = 1;
                        }
                        break;

                    case 'amount' :
                        value = parseInt(value, 10);
                        if (value < 1) {
                            this.errors.amount = 1;
                        }
                        break;
                }
            },

            clearError(field) {
                delete this.errors[field];
            }
        },

        created() {

        },

        mounted() {

        }
    }
</script>
