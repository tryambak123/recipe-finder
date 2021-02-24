# Introduction #
This application helps in deciding recipe to a person based on available ingredients

# How to setup
To setup the application clone the repo under htdocs folder in xampp or wamp and run the url
http://localhost/talent_cabin/recipe-finder/

# How to run
On opening the above URL in browser a form opens and it asks to upload 2 files. A file with json for recipes and another CSV file. On submit it displays possible recipes based on available ingredients.

#Test
For unit testing we have PHPUnit. We can check the ingredient and recipe file for it's validity as well as the logic to find the recipe.

## Assumptions (edge cases)
- If there is a recipe with no ingredients we ignore it
- If 2 recipes share the item with the closest expiration date we pick first 
