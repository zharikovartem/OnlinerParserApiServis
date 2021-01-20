import React, { useState, useEffect } from 'react'
import { DatePicker, Card, Divider, Button, Drawer, Tooltip } from 'antd'
import { FileAddOutlined } from '@ant-design/icons'
import moment from 'moment'
import NewTaskForm from './NewTaskFormContainer'

const ToDoList = (props) => {
    const [selectedDate, setselectedDate] = useState(moment())
    const [visible, setVisible] = useState(false)
    const [isAddActive, setIsAddActive] = useState(false)

    useEffect(() => {
        console.log('useEffect', props)
        if (props.taskList === null) {
            console.log(selectedDate.format('YYYY-MM-DD'))
            props.getToDoList(selectedDate.format('YYYY-MM-DD'))
        }

    }, [props.taskList]);

    useEffect(() => {
            props.getToDoList(selectedDate.format('YYYY-MM-DD'))
    }, [selectedDate]);

    const onDateChange = (value, dateString) => {
        if (value !== null) {
            setselectedDate(value)
            setIsAddActive(false)
        } else {
            setselectedDate(moment(null))
            setIsAddActive(true)
        }
    }

    const showDrawer = () => {
        setVisible(true);
      }

      const onClose = () => {
        setVisible(false);
      }

    // type timeScaleItemType = React.ReactElement<string>
    const timeScale = () => {
        let timeScaleArrey = []
        for (let index = 0; index < 24; index++) {
            let tasksBlock = [];
            if (props.taskList !== null) {
                for (let i = 0; i < props.taskList.length; i++) {
                    const element = props.taskList[i];
                    const timeVal = Number(element.time.split(':', 1))
                    // console.log('timeVal= ', timeVal)
                    const nextHour = index+1
                    if (timeVal >= index && timeVal< nextHour) {
                        console.log(element.time + 'to '+ index)
                        tasksBlock.push(
                            <Tooltip placement="topLeft" title={element.descriptions}>
                                <p>{element.time.split(':', 2).join(':')} - {element.name}</p>
                            </Tooltip>
                        )
                    }
                }
            }
            if (tasksBlock.length > 0 || index > 7) {
                timeScaleArrey.push(
                    <Divider key={index} orientation="left">
                        {index <= 9 ? '0' : null}{index}:00
                    </Divider>)
                timeScaleArrey.push(tasksBlock)
            }
        }
        return timeScaleArrey
    }

    console.log('ToDoList props: ', props)

    return (
        <>
            <div className="site-card-border-less-wrapper">
                <Card
                    title={
                        <>
                            <label>Select date:</label>
                            <DatePicker
                                onChange={onDateChange}
                                defaultValue={selectedDate}
                                format='DD-MM-YYYY'
                                style={{ marginLeft: 10 }}
                            />
                            <br/>
                            <Button 
                                type="primary" 
                                shape="round" 
                                icon={<FileAddOutlined />} 
                                style={{ marginLeft: 10 }} 
                                size="small" 
                                onClick={showDrawer}
                                disabled={isAddActive}
                            >
                                Add
                            </Button>
                        </>
                    }
                    bordered={false}
                >
                    {timeScale()}
                </Card>

                <Drawer
                    title={"Create New Task for " + selectedDate.format('DD MMM YYYY')}
                    placement="right"
                    closable={false}
                    onClose={onClose}
                    visible={visible}
                    width="80%"
                >
                    <NewTaskForm selectedDate={selectedDate}/>
                </Drawer>
            </div>

        </>
    )
}

export default ToDoList