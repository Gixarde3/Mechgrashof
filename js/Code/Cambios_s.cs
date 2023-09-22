using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using TMPro;
using CodeMonkey.Utils;
using System.Runtime.InteropServices;
public class Cambios_s : MonoBehaviour
{
    GameObject s;
    GameObject q;
    GameObject l;
    GameObject a;
    GameObject b;
    GameObject p;
    GameObject a_p;
    GameObject b_p;
    GameObject junta_1;
    GameObject junta_2;

    public GameObject junta_a;
    public GameObject junta_b;
    public GameObject junta_c;
    public GameObject junta_d;
    public Image play_pause;
    public Sprite play;
    public Sprite pause;

    public GameObject panel_error;
    public TMP_Text mensaje;
    public TMP_Text titulo;

    public InputField tam_s;
    public InputField tam_q;
    public InputField tam_p;
    public InputField tam_l;
    public InputField ang_s;
    public InputField ang_q;

    float x1;
    float x2;
    float y1;
    float y2;
    float angulo_q_v;

    string tam_s_d;
    string tam_q_d;
    string tam_l_d;
    string tam_p_d;
    string ang_s_d;
    string ang_q_d;
    string tam_listos;
    Vector3 position_a;
    Vector3 position_b;
    Vector3 position_a_original;
    Vector3 position_b_original;

    List<float> distancia_x_a_l;
    List<float> distancia_y_a_l;
    List<float> distancia_x_b_l;
    List<float> distancia_y_b_l;
    bool pausado;

    public InputField velocidad;
    float speed;
    // Start is called before the first frame update
    void Start()
    {
        pausado = true;
        tam_s_d = "53";
        tam_q_d = "135";
        tam_l_d = "211";
        tam_p_d = "220";
        //tam_listos = "53,90,135,120,220";
        q = GameObject.Find("junta_2/q");
        l = GameObject.Find("l");
        a = GameObject.Find("junta_1/s/A");
        s = GameObject.Find("junta_1/s");
        b = GameObject.Find("junta_2/q/B");
        p = GameObject.Find("p");
        a_p = GameObject.Find("p/A_p");
        b_p = GameObject.Find("p/B_p");
        junta_1 = GameObject.Find("junta_1");
        junta_2 = GameObject.Find("junta_2");
        x1 = a.transform.position.x;
        x2 = b.transform.position.x;
        y1 = a.transform.position.y;
        y2 = b.transform.position.y;
        cambiar_tam_s_ver("53",s);
        cambiar_tam_s_ver("135",q);
        cambiar_ang_s("90");
        cambiar_ang_q("120");
        cambiar_tam_s_ver("220",p);
        inicializar_medidas(tam_listos);
        position_a = a.transform.position;
        position_b = b.transform.position;
        position_a_original = a.transform.position;
        position_b_original = b.transform.position;
        distancia_x_a_l = new List<float>();
        distancia_y_a_l = new List<float>();
        distancia_x_b_l = new List<float>();
        distancia_y_b_l = new List<float>();
        ajustar();
    }
    [DllImport("__Internal")]
    private static extern void guardar_datos(string datos_iniciales);
    //[DllImport("__Internal")]
    //private static extern void graficar_u(float[] datos, int tam);
    public void iniciar(string medidas){
        tam_listos = medidas;
    }
    public void inicializar_medidas(string medidas){
        string[] datos = medidas.Split(',');
        Debug.Log(datos[0] + "XD");
        cambiar_tam_s_ver(datos[0],s);
        cambiar_ang_s(datos[1]);
        cambiar_tam_s_ver(datos[2],q);
        cambiar_ang_q(datos[3]);
        cambiar_tam_s_ver(datos[4],p);
        ajustar();
    }
    void ajustar(){
        x1 = a.transform.position.x;
        x2 = b.transform.position.x;
        y1 = a.transform.position.y;
        y2 = b.transform.position.y;
        float distancia_x = x2 - x1;
        float distancia_y = y2 - y1;
        float distancia = Mathf.Sqrt(Mathf.Pow(distancia_x, 2) + Mathf.Pow(distancia_y, 2));

        l.transform.localScale = new Vector3(distancia,l.transform.localScale.y, l.transform.localScale.z);
        l.transform.position = new Vector3((x1 + x2)/2f, (y1 + y2)/2f, 0f);
        l.transform.rotation = new Quaternion(0f,0f, 0f, 0f);

        float angulo = Mathf.Atan(distancia_y / distancia_x) * Mathf.Rad2Deg;
        if(a.transform.position.y > b.transform.position.y){
            angulo = Mathf.Atan(distancia_y / distancia_x) * Mathf.Rad2Deg;
        }else{
            angulo = Mathf.Atan(distancia_y / distancia_x) * Mathf.Rad2Deg;
        }
        l.transform.Rotate(new Vector3(0f,0f,angulo));
        tam_s.text = "" + s.transform.localScale.x * 7.5f;
        tam_q.text = "" + q.transform.localScale.x * 7.5f;
        tam_l.text = "" + l.transform.localScale.x;
        tam_p.text = "" + p.transform.localScale.x;  
        
        float junta_2_x = junta_2.transform.position.x;
        float junta_1_x = junta_1.transform.position.x;
        float junta_1_y = junta_1.transform.position.y;
        float junta_2_y = junta_2.transform.position.y;
        float dxAB = x2 - x1;
        float dxAJ = junta_2_x - x1;
        float angulo_mostrar;
        float distancia_x_m;
        float distancia_y_m;
        dxAJ = junta_2_x - x1;
        dxAB = x2 - x1;
        if(dxAJ < dxAB){
            distancia_x_m = x2 - junta_2_x;
            distancia_y_m = y2 - junta_2_y;
            angulo_mostrar = 180 - Mathf.Atan(distancia_y_m / distancia_x_m) * Mathf.Rad2Deg;
        }else if(dxAJ > dxAB){
            distancia_x_m = junta_2_x - x2;
            distancia_y_m = y2 - junta_2_y;
            angulo_mostrar = Mathf.Atan(distancia_y_m / distancia_x_m) * Mathf.Rad2Deg;
        }else{
            angulo_mostrar = 90f;
        }
        ang_q.text = "" + angulo_mostrar;
        dxAJ = x2 - junta_1_x;
        dxAB = x2 - x1;
        if(dxAJ < dxAB){
            distancia_x_m = junta_1_x - x1;
            distancia_y_m = y1 - junta_1_y;
            angulo_mostrar = 180f - Mathf.Atan(distancia_y_m / distancia_x_m) * Mathf.Rad2Deg;
        }else if(dxAJ > dxAB){
            distancia_x_m = x1 - junta_1_x;
            distancia_y_m = y1 - junta_1_y;
            angulo_mostrar = Mathf.Atan(distancia_y_m / distancia_x_m) * Mathf.Rad2Deg;
        }else{
            angulo_mostrar = 90f;
        }
        angulo_q_v = angulo_mostrar;
        ang_s.text = "" + angulo_mostrar;
        junta_1.transform.position = a_p.transform.position;
        junta_2.transform.position = b_p.transform.position;
        distancia_x_a_l = new List<float>();
        distancia_y_a_l = new List<float>();
        distancia_x_b_l = new List<float>();
        distancia_y_b_l = new List<float>();
        position_a = a.transform.position;
        position_b = b.transform.position;
        position_a_original = a.transform.position;
        position_b_original = b.transform.position;
        velocidad.text = "" + s.GetComponent<HingeJoint2D>().motor.motorSpeed;
    }
    // Update is called once per frame
    void Update()
    {
        junta_a.transform.position = junta_1.transform.position;
        junta_b.transform.position = junta_2.transform.position;
        junta_c.transform.position = a.transform.position;
        junta_d.transform.position = b.transform.position;
        position_a = a.transform.position;
        position_a = a.transform.position;
        if(play_pause.sprite == pause){
            distancia_x_a_l.Add(position_a_original.x - position_a.x);
            distancia_y_a_l.Add(position_a_original.y - position_a.y);
            distancia_x_b_l.Add(position_b_original.x - position_b.x);
            distancia_y_b_l.Add(position_b_original.y - position_b.y);
        }
    }
    public void abrir_cerrar_panel(GameObject panel){
        if(panel != null){
            panel.SetActive(!panel.activeSelf);
        }
    }
    bool verificar(string tam_s_d, string tam_q_d, string tam_p_d){
        float[] barras = new float[4];
        float[] ordenadas = new float[4];
        //s: 0, q: 1, p: 2, l: 3
        ajustar();
        float barra_s = float.Parse(tam_s.text);
        float barra_l = float.Parse(tam_l.text);
        barras[0] = float.Parse(tam_s.text);
        barras[1] = float.Parse(tam_q.text);
        barras[2] = float.Parse(tam_p.text);
        barras[3] = float.Parse(tam_l.text);
        int i, j;
        float tmp;
    
        for(i = 1; i < 4; i++){
            for(j = 0; j < 3; j++){
                if(barras[j] > barras[j + 1]){
                    tmp = barras[j + 1];
                    barras[j + 1] = barras[j];
                    barras[j] = tmp;
                }
            }
        }
        //Debug.Log("(" + barras[0] + "+" + barras[3] + ")" + "<=" + "(" + barras[2] + "+" + barras[1] +") && " + barras[0]  + "=="  + barra_s);
        if(!(((barras[0] + barras[3]) <= (barras[2] + barras[1])) && barras[0] == barra_s && barras[3] == barra_l)){
            titulo.text = "Error de medidas.";
            mensaje.text = "Las medidas ingresadas impiden el correcto funcionamiento del simulador.";
            abrir_cerrar_panel(panel_error);
            cambiar_tam_s_ver(tam_s_d, s);
            cambiar_tam_s_ver(tam_p_d, p);
            cambiar_tam_s_ver(tam_q_d, q);
            return false;
        }
        return true;
    }
    public void agrandar(GameObject s){
        float anterior = s.transform.localScale.x;
       if(s != p){
            s.transform.localScale = new Vector3(s.transform.localScale.x + 0.1333f, s.transform.localScale.y, s.transform.localScale.z);
        }else{
            s.transform.localScale = new Vector3(s.transform.localScale.x + 1f, s.transform.localScale.y, s.transform.localScale.z);
        }
        float actual = s.transform.localScale.x;
        float razon = actual / anterior;
        if(s != p){
            s.transform.localPosition = new Vector3(s.transform.localPosition.x, s.transform.localPosition.y * razon, s.transform.localPosition.z);
        }
        ajustar();
    }
    public void achicar(GameObject s){
        float anterior = s.transform.localScale.x;
        if(s != p){
            s.transform.localScale = new Vector3(s.transform.localScale.x - 0.1333f, s.transform.localScale.y, s.transform.localScale.z);
        }else{
            s.transform.localScale = new Vector3(s.transform.localScale.x - 1f, s.transform.localScale.y, s.transform.localScale.z);
        }

        float actual = s.transform.localScale.x;
        float razon = actual / anterior;
        if(s != p){
            s.transform.localPosition = new Vector3(s.transform.localPosition.x, s.transform.localPosition.y * razon, s.transform.localPosition.z);
        }
        ajustar();
    }
    public void empezar_pausar(HingeJoint2D s){
        pausado = !pausado;
        HingeJoint2D pieza = s;
        var motor = pieza.motor;
        if(pausado){
            pieza.useMotor = true;
            motor.motorSpeed = speed;
            play_pause.sprite = pause;
            velocidad.text = "" + speed;
           }else{
            speed = motor.motorSpeed;
            motor.motorSpeed = 0;
            pieza.useMotor = false;
            play_pause.sprite = play;
        }
        pieza.motor = motor;
    }
    public void cambiar_velocidad(string velocidad){
        HingeJoint2D pieza = s.GetComponent<HingeJoint2D>();
        var motor = pieza.motor;
        motor.motorSpeed = float.Parse(velocidad);
        pieza.motor = motor;
        play_pause.sprite = pause;
        speed = motor.motorSpeed;
        ajustar();
    }
    public void cambiar_tam_s(string tam){
        cambiar_tam(tam, s);
    }
    public void cambiar_tam_q(string tam){
        cambiar_tam(tam, q);
    }
    public void cambiar_tam_p(string tam){
        cambiar_tam(tam, p);
    }
    public void cambiar_ang_s(string ang){
        cambiar_ang(ang, s);
    }
    public void cambiar_ang_q(string ang){
        float angulo_n = 180f - float.Parse(ang);
        cambiar_ang("" + angulo_n, q);
    }
    void cambiar_ang_s_ver(string ang, GameObject barra){
        float angulo = float.Parse(ang);
        if(angulo > 180 || angulo < 0){
            titulo.text = "Error de ángulos.";
            mensaje.text = "Las medidas asignadas en los ángulos impiden el correcto movimiento del mecanismo.";
            abrir_cerrar_panel(panel_error);
            ajustar();
            return;
        }else{
            GameObject junta = barra == s ? junta_1 : junta_2;
            junta.transform.rotation = new Quaternion(0f,0f,0f,0f);
            float angulo_barra = angulo - barra.transform.localRotation.eulerAngles.z;
            junta.transform.Rotate(new Vector3(0f,0f,angulo_barra));
            tam_s_d = tam_s.text;
            tam_q_d = tam_q.text;
            tam_l_d = tam_l.text;
            tam_p_d = tam_p.text;
            ajustar();
        }
    }
    void cambiar_ang(string ang, GameObject barra){
        float angulo = float.Parse(ang);
        if(angulo > 180 || angulo < 0){
            titulo.text = "Error de ángulos.";
            mensaje.text = "Las medidas asignadas en los ángulos impiden el correcto movimiento del mecanismo.";
            abrir_cerrar_panel(panel_error);
            ajustar();
            return;
        }else{
            GameObject junta = barra == s ? junta_1 : junta_2;
            junta.transform.rotation = new Quaternion(0f,0f,0f,0f);
            float angulo_barra = angulo - barra.transform.localRotation.eulerAngles.z;
            junta.transform.Rotate(new Vector3(0f,0f,angulo_barra));
            ajustar();
        }
        
    }
    void cambiar_tam(string tam, GameObject barra){
        
        float size = int.Parse(tam) / 7.5f;
        if(barra == p){
            size = int.Parse(tam);
        }
        if(size != 0){
            size += 1f / 7.5f;
            float actual = barra.transform.localScale.x;
            if(size > actual){
                while(size > barra.transform.localScale.x){
                    agrandar(barra);
                }
            }else{
                while(barra.transform.localScale.x > size){
                    achicar(barra);
                }
            }
            if(verificar(tam_s_d, tam_q_d, tam_p_d)){
                tam_s_d = tam_s.text;
                tam_q_d = tam_q.text;
                tam_l_d = tam_l.text;
                tam_p_d = tam_p.text;
                ang_s_d = ang_s.text;
                ang_q_d = ang_q.text;
            }
        }
    }
    void cambiar_tam_s_ver(string tam, GameObject barra){
        float size = int.Parse(tam) / 7.5f;
        
        if(barra == p){
            size = int.Parse(tam);
        }
        size += 1f / 7.5f;
        float actual = barra.transform.localScale.x;
        if(size > actual){
            while(size > barra.transform.localScale.x){
                agrandar(barra);
            }
        }else{
            while(barra.transform.localScale.x > size){
                achicar(barra);
            }
        }
        tam_s_d = tam_s.text;
        tam_q_d = tam_q.text;
        tam_l_d = tam_l.text;
        tam_p_d = tam_p.text;
        ang_q_d = ang_q.text;
        ang_s_d = ang_s.text;
    }
    public void guardar(){
        string datos_iniciales;
        datos_iniciales = tam_s.text + "," + ang_s.text + "," + tam_q.text + "," + ang_q.text + "," + tam_p.text;
        guardar_datos(datos_iniciales);
    }
    /*public void graficar(){
        float[] datos = distancia_x_a_l.ToArray();
        graficar_u(datos, datos.Length);
    }*/
}