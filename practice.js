class subject {                                         // Parent Class : A class that is extended by another class. It can have properties and methods that are inherited by the child class.
constructor(name, teacher) {                            // Constructor : A special function which runs automatically when an object is created. It is used to initialize the properties of the object.
        this.name = name;                               // this. : A keyword that refers to the current instance of the class. It is used to access the properties and methods of the class.
        this.teacher = teacher;
    }

    getName() {                                         // Encapsulation : The concept of bundling data (properties) and methods that operate on the data into a single unit (class). It helps to protect the data from unauthorized access and modification.
        let msg = " Subject name is: " + this.name;
        return msg;
    }

    getTeacher() {          
        let msg = " Teacher name is: " + this.teacher;
        return msg;
    }

    getDetails() {                                     // Polymorphism : The ability of a class to take on many forms. It allows methods to do different things based on the object it is acting upon, even if they share the same name.
        let msg = " Subject name is: " + this.name + " and Teacher name is: " + this.teacher;
        return msg;
    }
}

class english extends subject {                          // Child Class : A class that inherits properties and methods from another class. It can have its own properties and methods in addition to the inherited ones.
    constructor(name, teacher, level) {                     
        this.level = level;
        super(name, teacher);                           // Super() : A keyword that is used to call the constructor of the parent class. It must be called before accessing 'this' in the child class constructor.                                                      
    }

    getLevel() {
        let msg = " Level is: " + this.level;
        return msg;
    }

    getDetails() {                                      // Polymorphism
        let msg = "Level is: " + this.level;
        return msg;
    }
}

class computer extends subject {
    constructor(name, teacher, language) {
        super(name, teacher);
        this.language = language;
    }

    getLanguage() {
        let msg = " Programming language is: " + this.language;
        return msg;
    }

    getDetails() {                                      // Polymorphism
        let msg = "Computer Child Class";   
        return msg;
    }
}

let englishSubject = new english("English", "Mr. Smith", "Advanced");
console.log(englishSubject.getName());
console.log(englishSubject.getTeacher());
console.log(englishSubject.getLevel());

let computerSubject = new computer("Computer Science", "Ms. Johnson", "JavaScript");
console.log(computerSubject.getName());
console.log(computerSubject.getTeacher());
console.log(computerSubject.getLanguage());     