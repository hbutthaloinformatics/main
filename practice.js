class subject {
    constructor(name, teacher) {
        this.name = name;
        this.teacher = teacher;
    }

    getName() {
        let msg = " Subject name is: " + this.name;
        return msg;
    }

    getTeacher() {
        let msg = " Teacher name is: " + this.teacher;
        return msg;
    }
}

class english extends subject {
    constructor(name, teacher, level) {
        super(name, teacher);
        this.level = level;
    }

    getLevel() {
        let msg = " Level is: " + this.level;
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
}

let englishSubject = new english("English", "Mr. Smith", "Advanced");
console.log(englishSubject.getName());
console.log(englishSubject.getTeacher());
console.log(englishSubject.getLevel());

let computerSubject = new computer("Computer Science", "Ms. Johnson", "JavaScript");
console.log(computerSubject.getName());
console.log(computerSubject.getTeacher());
console.log(computerSubject.getLanguage());     

// Output:
//  Subject name is: English
//  Teacher name is: Mr. Smith
//  Level is: Advanced
//  Subject name is: Computer Science
//  Teacher name is: Ms. Johnson
//  Programming language is: JavaScript