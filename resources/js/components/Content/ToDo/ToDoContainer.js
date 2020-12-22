import {connect} from 'react-redux';
import ToDo from './ToDo';
import {getToDoList, createNewTask} from './../../../redux/toDoReducer';

let mapStateToProps = (state) => {
    return {
        ToDoData: state.toDo.ToDoData,
        // user: state.user.user,
        // userStatus: state.user.userStatus,
    }
}

export default connect(mapStateToProps, 
    {getToDoList, createNewTask}) 
    (ToDo);