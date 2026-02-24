class subject {
    constructor(name, teacher) {
        this.name = name;
        this.teacher = teacher;
    }

    getName() {
        $msg = " Subject name is: " + this.name;
        return $msg;
    }

    getTeacher() {
        $msg = " Teacher name is: " + this.teacher;
        return $msg;
    }
}