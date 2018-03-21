<template>
    <div>
        <div @click="toggleEditingStatus">
            {{ ingredient.name }} <span v-show="ingredient.amount > 1">({{ ingredient.amount }}x)</span>
        </div>
        <div v-show="isEditing">
            <div class="btn-group" role="group" aria-label="Basic example">
                <span class="btn btn-outline-info" @click="consume">consume</span>
                <span class="btn btn-outline-info" @click="stockUp">stock up</span>
                <span class="btn btn-outline-info" @click="deplete">deplete</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['dataIngredient'],

        data() {
            return {
                ingredient: {},
                isEditing: false,
            };
        },

        methods: {
            toggleEditingStatus() {
                this.isEditing = !this.isEditing;
            },

            consume() {
                let that = this;

                axios
                    .get(route('ingredients.consume', this.ingredient.id))
                    .then(function(response) {
                        that.ingredient.amount = response.data.amount;

                        if (that.ingredient.amount < 1) {
                            that.deplete();
                        }
                    });
            },

            stockUp() {
                let that = this;

                axios
                    .get(route('ingredients.stockup', this.ingredient.id))
                    .then(function(response) {
                        that.ingredient.amount = response.data.amount;
                    });
            },

            deplete() {
                let that = this;

                axios
                    .get(route('ingredients.deplete', this.ingredient.id))
                    .then(function(response) {
                        that.ingredient.amount = response.data.amount;

                        /* Bubble depletion to the parent component */

                        that.$emit('depleted');
                    });
            }
        },

        created() {
            this.ingredient = this.dataIngredient;
        },

        mounted() {

        }
    }
</script>
