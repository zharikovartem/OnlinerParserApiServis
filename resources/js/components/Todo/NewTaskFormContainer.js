import {connect} from 'react-redux';
import NewTaskForm from './NewTaskForm';
import {createNewTask} from './../../redux/toDoReducer';

let mapStateToProps = (state) => {
    console.log(state)
    return {
        ToDoData: state.toDo.ToDoData,
        taskList: state.toDo.taskList,
        user: state.user.user
        // user: state.user.user,
        // userStatus: state.user.userStatus,
    }
}

export default connect(mapStateToProps, 
    {createNewTask}) 
    (NewTaskForm);