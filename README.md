##Final project for the Databases Management Systems class (Fall Semester 15/16)

#About
The project consists of implementing a Note Book app to explore some concepts Database related concepts.

The *initial_tables* folder contains the needed files to create the tables for the MySQL Database for this app.
The *NoteBookModel.pdf* file contains the Entity-Relationship Model developed.

The semi-functional NoteBook app is implemented using a PHP back-end in the *notes_app* folder. 

In the *answers_to_questions* folder some Database Management Systems concepts are explored and applied to this app.
These include: 
* retrieving knowledge from the app's Database using queries; 
* integrity constraints, concretely applied using MySQL triggers; 
* optimization of the most frequent queries using indexes; 
* normal forms for the tables in the database; 
* data wharehousing, concretely applied using a star schema.

#Using of the Note Book app
First copy the *notes_app* folder.

Then place the root of your server in the *notes_app/public folder*.

After that you should create your database and change the content of the *notes_app/utils/constants.php* file accordingly.

To create the correct tables for your database schema run the *initital_tables/create_tables.sql* script.

Finally, just visit the server that is runnning the app.
