import React, { Component } from 'react';
import RegisterContainer from './RegisterContainer ';
// class Register extends Component {
//   constructor(props) {
//     super(props);
//     this.state = {
//       redirect: props.location,
//     }
//   }
//   render() {
//     return (
//       <div className="content">
//         <RegisterContainer redirect={this.state.redirect} />
//       </div>
//     )
//   }
// }

const Register = (props) => {
  console.log('Register props: ', props);
  return (
    <div className="content">
      {/* <RegisterContainer redirect={props.redirect} /> */}
      Register
    </div>
  );
}
export default Register