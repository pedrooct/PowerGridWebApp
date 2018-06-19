
var nodes = new vis.DataSet();
var edges = new vis.DataSet();


function getNodeID()
{
  return nodes.length;
}
function addNode(id,nome,tipo)
{
  nodes.add([{id: id, label: nome+"-"+id, group:tipo}]);
  return true;
}
function connect(from,to)
{
  if(existNode(from) && existNode(to))
  {
    if(canGroupsConnect(from,to))
    {
      edges.add([{from: from, to: to, arrows:'to'}]);
      return true;
    }
    return false;
  }
  return false;

}
function canGroupsConnect(from,to)
{
  var itemFrom=nodes.get(from);
  var itemTo=nodes.get(to);
  if(itemFrom.group == 1 && itemTo.group==0)
  {
    return true;
  }
  if(itemFrom.group == 1 && itemTo.group==1)
  {
    return true;
  }
  if(itemFrom.group == 2 && itemTo.group==1)
  {
    return true;
  }
  return false;
}
function getNode()
{
  return nodes;
}
function existNode(id) {
  var item=nodes.get(id);
  if(item == null)
  {
    return false;
  }
  return true;

}

function getEdges()
{
  return edges;
}

function saveFile()
{
  var data = {
    nodes: nodes,
    edges: edges
  };
  var dataJSON = JSON.stringify(data);
  return dataJSON;
}
function loadFile(contents)
{
  data = JSON.parse(contents);
  var lengthN=data.nodes.length;
  var lengthE=data.edges.length;
  dataN=data.nodes._data;
  dataE=data.edges._data;
  var i;
  for(i=0;i<lengthN;i++)
  {
    addNode(dataN[i].id,dataN[i].label,dataN[i].group);
  }
  for (key in dataE) {
    connect(dataE[key].from,dataE[key].to);
  }
  return true;
}

/*var edges = new vis.DataSet([
{from: 1, to: 8, arrows:'to', dashes:true},
{from: 1, to: 3, arrows:'to'},
{from: 1, to: 2, arrows:'to, from'},
{from: 2, to: 4, arrows:'to, middle'},
{from: 2, to: 5, arrows:'to, middle, from'},
{from: 5, to: 6, arrows:{to:{scaleFactor:2}}},
{from: 6, to: 7, arrows:{middle:{scaleFactor:0.5},from:true}}
]);*/
/*var nodes = new vis.DataSet([
{id: 1, label: 'Node 1'},
{id: 2, label: 'Node 2'},
{id: 3, label: 'Node 3'},
{id: 4, label: 'Node 4'},
{id: 5, label: 'Node 5'},
{id: 6, label: 'Node 6'},
{id: 7, label: 'Node 7'},
{id: 8, label: 'Node 8'}
]);*/
