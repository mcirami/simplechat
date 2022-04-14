import {BrowserRouter, Routes, Route} from 'react-router-dom';
import Script from './Pages/Script';
import Layout from './Pages/Layout';
import Keywords from './Pages/Keywords';
import Links from './Pages/Links';
import Pictures from './Pages/Pictures';
import KeepAlive from './Pages/KeepAlive';


function App() {

    return (
        <BrowserRouter>
           <Routes>
               <Route path='/settings' element={<Layout />}>
                   <Route index element={<Script />} />
                   <Route path='keywords' element={<Keywords />} />
                   <Route path='links' element={<Links />} />
                   <Route path='pictures' element={<Pictures />} />
                   <Route path='keepalive' element={<KeepAlive />} />
               </Route>
           </Routes>
        </BrowserRouter>
    )
}

export default App;
