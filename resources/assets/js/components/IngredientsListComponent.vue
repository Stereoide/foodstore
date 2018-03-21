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
                                <li class="list-group-item" v-for="ingredient in orderedIngredients" :key="ingredient.id">
                                    <ingredient :data-ingredient="ingredient" @depleted="depleteIngredient(ingredient)"></ingredient>
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

        computed: {
            orderedIngredients() {
                return this.ingredients.sort((a, b) => a.name > b.name );
            }
        },

        methods: {
            depleteIngredient(depletedIngredient) {
                this.ingredients = this.ingredients.filter(ingredient => ingredient.id !== depletedIngredient.id);
            },

            saveNewIngredient(ingredient) {
                let that = this;

                axios
                    .post(route('ingredients.store'), ingredient)
                    .then(function(response) {
                        that.ingredients.push(response.data);
                        that.isAddingIngredient = false;
                    });
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
