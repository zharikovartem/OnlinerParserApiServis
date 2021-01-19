import {connect} from 'react-redux';
import ToDoList from './ToDoList';
import {getToDoList, createNewTask} from './../../redux/toDoReducer';

let mapStateToProps = (state) => {
    console.log(state)
    return {
        ToDoData: state.toDo.ToDoData,
        taskList: state.toDo.taskList,
        // user: state.user.user,
        // userStatus: state.user.userStatus,
    }
}

export default connect(mapStateToProps, 
    {getToDoList, createNewTask}) 
    (ToDoList);