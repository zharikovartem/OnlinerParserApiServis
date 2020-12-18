export const connectToServ = (topic_id, thunk) => {
    return new ab.connect(
        'ws:Localhost:8080',
        function(session) {
            session.subscribe(paramsTarget+'Desc', function(topic, data) {
                // console.info('new data topic id: "'+topic+'"');
                console.log(data.data);
    
                if (data.data === 'end') {
                    alert('end');
                } else {

                }
                // props.setCatalogReload()
            });
        },
    
        function(code, reason, detail) {
            console.warn('WebSocket connection closed: code='+code+'; reason='+reason+'; detail='+detail);
        },
    
        {
            'maxRetries': 60,
            'retryDelay': 4000,
            'skipSubprotocolCheck': true
        }
    );
}

// export default connectToServ;