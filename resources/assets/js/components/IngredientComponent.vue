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
                this.ingredient.amount--;

                if (this.ingredient.amount < 1) {
                    this.deplete();
                }
            },

            stockUp() {
                this.ingredient.amount++;
            },

            deplete() {
                this.ingredient.amount = 0;

                /* Bubble depletion to the parent component */

                this.$emit('depleted');
            }
        },

        created() {
            this.ingredient = this.dataIngredient;
        },

        mounted() {

        }
    }
</script>
