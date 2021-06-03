# Routes

## Sprint 1

| URL | HTTP Method | Controller | Method | Title | Content | Comment |
|--|--|--|--|--|--|--|
| `/` | `GET` | `MainController` | `home` | Dans les shoe | 5 categories | - |
| `/categories`| `GET`| `MainController` | `categories` | Liste  des Categories | Categories List  | - |
| `/product` | `GET` | `MainController` | `product` | Liste des Produits | Products List | - |
| `/type` | `GET` | `MainController` | `type` | Liste des Types |  Types List | - |
| `/brand` | `GET` | `MainController` | `brand` | Liste des Marques | Brand List | - |
| `/tag` | `GET` | `MainController` | `tag` | Liste des Tags | Tags List | - |
| `/category_add`| `GET`| `MainController` | `category_add` |  Ajouter une Categorie | Add Categories   | - |
| `/product_add` | `GET` | `MainController` | `product_add` | Ajouter un Produit |Add  Products | - |
| `/type_add` | `GET` | `MainController` | `type_add` | Ajouter un Type |  Add Types  | - |
| `/brand_add` | `GET` | `MainController` | `brand_add` | Ajouter une Marque | Add Brand | - |
| `/tag_add` | `GET` | `MainController` | `tag_add` | Ajouter un Tag | Add Tags  | - |
| `/category_update/[i:id]`| `GET`| `MainController` | `category_update` |  Mettre à jour une Categorie | Update Categories   | (`[id]`) => represent the id of the category |
| `/product_update/[i:id]` | `GET` | `MainController` | `product_update` | Mettre à jour un Produit |Update  Products | (`[id]`) => represent the id of the product |
| `/type_update/[i:id]` | `GET` | `MainController` | `type_update` | Mettre à jour un Type |  Update Types  | (`[id]`) => represent the id of the type |
| `/brand_update/[i:id]` | `GET` | `MainController` | `brand_update` | Mettre à jour une Marque | Update Brand | (`[id]`) => represent the id of the brand |
| `/tag_update/[i:id]` | `GET` | `MainController` | `tag_update` | Mettre à jour un Tag | Update Tags  | (`[id]`) => represent the id of the tag |
