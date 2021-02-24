# Introduction #
This application helps in deciding recipe to a person based on available ingredients

# How to setup
To setup the application clone the repo under htdocs folder in xampp or wamp 
git clone https://github.com/tryambak123/recipe-finder.git


# How to run
run the url
http://localhost/recipe-finder/

On opening the above URL in browser a form opens and it asks to upload 2 files. A file with json for recipes and another CSV file. The sample files are already there under project. Browse to data/fridge.csv and data/recipes.json to upload. On submit it displays possible recipes based on available ingredients.

# Test
For unit testing we have PHPUnit. We can check the ingredient and recipe file for it's validity as well as the logic to find the recipe.
To run the test we run the test on console.

# Steps to run the Test
1.open cmoomand prompt
2. cd to recipe-finder
3. Run command vendor/bin/phpunit --verbose tests/unit/RecipesTest.php - It will display the test result
4. Same commad for running Ingredients test also : vendor/bin/phpunit --verbose tests/unit/IngredientsTest.php

## Assumptions (edge cases)
- If there is a recipe with no ingredients we ignore it
- If 2 recipes share the item with the closest expiration date we pick first 
