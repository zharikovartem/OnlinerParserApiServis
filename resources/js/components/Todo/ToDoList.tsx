import React, { useState } from 'react'
import { DatePicker, Card, Divider, Button, Drawer } from 'antd'
import { FileAddOutlined } from '@ant-design/icons'
import moment from 'moment'
import NewTaskForm from './NewTaskForm'

const ToDoList: React.FC = () => {
    const [selectedDate, setselectedDate] = useState<moment.Moment>(moment())
    const [visible, setVisible] = useState(false)
    const [isAddActive, setIsAddActive] = useState(false)

    const onDateChange = (value: moment.Moment | null, dateString: string): void => {
        if (value !== null) {
            setselectedDate(value)
            setIsAddActive(false)
        } else {
            setselectedDate(moment(null))
            setIsAddActive(true)
        }
    }

    const showDrawer = ():void => {
        setVisible(true);
      }

      const onClose = ():void => {
        setVisible(false);
      }

    type timeScaleItemType = React.ReactElement<string>
    const timeScale = (): Array<timeScaleItemType> => {
        let timeScaleArrey: Array<timeScaleItemType> = []
        for (let index: number = 0; index < 24; index++) {

            timeScaleArrey.push(
                <Divider key={index} orientation="left">
                    {index <= 9 ? '0' : null}{index}:00
                </Divider>)
        }
        return timeScaleArrey
    }

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