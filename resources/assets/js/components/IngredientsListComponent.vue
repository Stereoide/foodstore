<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ingredients</div>

                    <div class="card-body">
                        <div v-show="ingredients.length == 0">
                            No ingredients right now
                        </div>

                        <div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <new-ingredient v-show="isAddingIngredient" @saved="saveNewIngredient" @cancelled="cancelNewIngredient"></new-ingredient>
                                    <span class="btn btn-outline-info" v-show="!isAddingIngredient" @click="isAddingIngredient = true">Add ingredient</span>
                                </li>
                                <li class="list-group-item" v-for="(ingredient, index) in ingredients">
                                    <ingredient :data-ingredient="ingredient" @depleted="depleteIngredient(index)"></ingredient>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['dataIngredients'],

        data() {
            return {
                ingredients: {},
                isAddingIngredient: false,
            };
        },

        methods: {
            depleteIngredient(index) {
                this.ingredients.splice(index, 1);
            },

            saveNewIngredient(ingredient) {
                this.ingredients.push(ingredient);
                this.isAddingIngredient = false;
            },

            cancelNewIngredient() {
                this.isAddingIngredient = false;
            }
        },

        created() {
            this.ingredients = this.dataIngredients;
        },

        mounted() {

        }
    }
</script>
