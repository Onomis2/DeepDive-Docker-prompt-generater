# Website for better prompt

We have created a website where you can improve your prompts so that an AI gives a better outcome, for example: If you want an explanation about a piece of code, you can click on code and then on give an explanation in this case and if you then click on submit, it will send you to chatgpt with your question and extra perimeters to get better results. We also have a working AI in the website that makes your question a better question, there are also two buttons that appear here, 1 that immediately sends you to chatgpt with your question, but there is also another button that copies that piece of text and you can paste it into another AI.

## Adding prompts

You can also add all kinds of prompts, this is only possible if you are an administrator, you must be able to log in for this. If you are logged in as an administrator, you can add or remove things, there are 2 buttons for this, if you click on add on the start page, you can add a subject and add the given perimeter. If you have done this and then click on what you have added, you can also add what you want, for example: Give you an explanation of how to do it or just get the answer, this also works for deleting, but then you do not have to write anything, you only have to select what you want to delete.

## set-up

First need to install docker first for your machine.

https://www.docker.com/

After you have installed docker than you can do this command in your command prompt this needs to be on one single line.
>
    docker run --name my-phpmyadmin -d --link database_for_promptbook:db -p 8080:80 -e PMA_HOST=database_for_promptbook phpmyadmin:latest && \ docker run -d -v ollama:/root/.ollama -p 11434:11434 --name ollama ollama/ollama && \ docker exec -it ollama ollama run llama3

If everything is running than you can go to the phpmyadmin and you click on the database with the name promptbook than click on sql and than paste the code from import.sql in it or if you already have the database than you can run the code from reset.sql.

If everything is running, you can download and run the code from this repository and it should host your website.