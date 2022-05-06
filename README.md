# Laravem Code Generator

This package is developed to put some sort of standart codes into the target files in order to increase productivity.

### Installation
```
sail composer require bakgul/laravel-code-generator
```
## Eloquent Relationships
This package can be used to add Eloquent relationship into models and migrations. The implemented relations are:

+ one to one
+ one to one polymorphic
+ has one through
+ one to many
+ one to many polymorphic
+ has many through
+ many to many
+ many to many polymorphic

In the future release, **one of many** will also be covered.

## Signature
```
create:relation {relation} {from} {to} {mediator?} {--m|model} {--p|polymorphic}
```
### Expected Inputs
+ **Relation**: One of the shorthands of the type of the eloquent relations:
  + oto : One to One
  + otm : One to Many
  + mtm : Many to Many
+ **Model**: While generating a many-to-many relationship, a model for pivot table will be created if " **-m** " or " **--model** " is added to the command.
+ **Polymorphic**: When the command has  " **-p** " or " **--polymorphic** the relation will be converted to polymorhic one.
### Syntax
On the following list of arguments, you can find how to pass them.
+ **From**:
  + **Role**: This is the **"has"** part of the relationship.
  + **Schema**: package/model:column
  + **Details**:
    + **package**: It's optional.
      + *exists*: Model is searched in the specified package.
      + *missing*: All possible model's containers are checked to find the model.
    + **model**: It's required.
    + **column**: It's optional.
      + *exists*: The local key will be the given column.
      + *missing*: By default it is **"id"**
+ **To**:
  + **Role**: This is the **"belongsTo"** part of the relationship.
  + **Schema**: package/model:column
  + **Details**:
    + **package**: It's optional.
      + *exists*: Model is searched in the specified package.
      + *missing*: All possible model's containers are checked to find the model.
    + **model**: It's required.
    + **column**: It's optional.
      + *exists*: The foreing key will be the given column.
      + *missing*: By default it's generated based on the model name of the "From" or "Mediator" (if relationship is "through"). For example, if the model is User, then the column will be "user_id"
+ **Mediator (as through)**:
  + **Role**: This is the middleman of the "Has One Through" and "Has Many Through" relationships.
  + **Schema**: package/model:column
  + **Details**:
    + **package**: It's optional.
      + *exists*: Model is searched in the specified package. If it can't be found, it will be created there.
      + *missing*: All possible model's containers are checked to find the model. If it can't be found, it will be created in the same namespace as **From**
    + **model**: It's required.
    + **column**: It's optional.
      + *exists*: The foreign key will be the given column.
      + *missing*: By default it's generated based on the model name of the "From" side. For example, if the model is User, then the column will be "user_id"
+ **mediator as pivot**: package/table:model




